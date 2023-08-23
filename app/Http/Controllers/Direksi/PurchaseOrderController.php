<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Order;
use App\Models\Admin\Purchase_Order_Detail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $title = 'Purchase Order';
        $menyetujui = Auth::guard('direksi')->user()->nama;
        $dataPO = DB::table('admin_purchase_order')
            ->where(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where(function ($query) {
                        $query->where('status_approved', 'rejected')
                            ->orWhere('status_paid', 'rejected');
                    });
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'paid');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', '<>', $menyetujui)
                    ->where('status_approved', 'rejected')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', '<>', $menyetujui)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->where(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->orWhere('menyetujui', $menyetujui);
            })
            ->orderByRaw("CASE WHEN status_approved = 'pending' AND status_paid = 'pending' THEN 0 WHEN status_approved = 'pending' OR status_paid = 'pending' THEN 1 ELSE 2 END, CASE WHEN pemohon = 'Yacob' THEN 1 ELSE 2 END")
            ->paginate(10);
        return view('halaman_direksi.purchase_order.index', [
            'title' => $title,
            'PO' => $dataPO
        ]);
    }

    public function view_PO($id)
    {
        $title = 'Lihat Purchase Order';
        $PO = DB::table('admin_purchase_order')->find($id);
        $PO_Nominal = DB::table('admin_purchase_order')->where('id', $id)->get();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $results = [];
        foreach ($PO_Nominal as $item) {
            $result = ($item->PPN / 100) * $nominal_PO;
            $PPH = ($item->PPH / 100) * $nominal_PO;
            $PPH_4 = ($item->PPH_4 / 100) * $nominal_PO;
            $ctm_2 = ($item->ctm_2 / 100) * $nominal_PO;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH - $PPH_4 - $ctm_2;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');

        return view('halaman_direksi.purchase_order.view_PO', [
            'title' => $title,
            'PO' => $PO,
            'PO_detail' => $PO_detail,
            'nominal' => $nominal_PO,
            'PPN' => $result,
            'PPH' => $PPH,
            'PPH_4' => $PPH_4,
            'ctm_2' => $ctm_2,
            'grand_total' => $grand_total,
            'tgl_purchasing' => $formattedDate
        ]);
    }

    public function setujui_PO($id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
                'tgl_approval' => Carbon::now()
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.purchase_order')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.purchase_order')->with('gagal', $e->getMessage());
        }
    }

    public function tolak_PO(Request $request, $id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.purchase_order')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . '. Mohon Ajukan PO yang berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.purchase_order')->with('gagal', $e->getMessage());
        }
    }
    public function print_PO($id)
    {
        $title = 'Cetak Purchase Order';
        $PO = DB::table('admin_purchase_order')->where('id', $id)->first();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $PO_Detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $results = [];
        foreach ($PO_Detail as $item) {
            $result = ($item->PPN / 100) * $item->nominal;
            $PPH = ($item->PPH / 100) * $item->nominal;
            $PPH_4 = ($item->PPH_4 / 100) * $item->nominal;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');

        return view('halaman_direksi.purchase_order.print_PO', [
            'title' => $title,
            'PO' => $PO,
            'PO_detail' => $PO_detail,
            'nominal' => $nominal_PO,
            'PPN' => $result,
            'PPH' => $PPH,
            'PPH_4' => $PPH_4,
            'grand_total' => $grand_total,
            'tgl_purchasing' => $formattedDate
        ]);
    }
    public function tambah_PO()
    {
        $title = 'Tambah Purchase Order';
        $AWAL = 'PO';

        $bulanRomawi = array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $noUrutAkhir = DB::table('admin_purchase_order')->whereMonth('tgl_purchasing', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if (date('j') == 1) {
            $no_dokumen = sprintf("%02s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
            } else {
                $no_dokumen = sprintf("%02s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
            }
        }
        $karyawan = Auth::guard('direksi')->user()->nama;
        $tipe_pr = DB::select('SELECT * FROM admin_purchase_request WHERE pemohon = ?', [$karyawan]);
        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');
        $kurs = DB::select('SELECT * FROM kurs');

        $supplier = DB::select('SELECT * FROM supplier WHERE PIC = ?', [$karyawan]);

        return view('halaman_direksi.purchase_order.tambah_PO', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'tipe_pr' => $tipe_pr,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $kurs,
            'supplier' => $supplier,
        ]);
    }
    public function getDataBySupplier(Request $request)
    {
        $supplier = $request->input('supplier');
        $pemohonMenyetujuiData = DB::table('supplier')->where('nama_supplier', $supplier)->first();
        if ($pemohonMenyetujuiData) {
            // Menggabungkan data pemohon dan menyetujui ke dalam satu array
            $data = [
                'pemohon' => $pemohonMenyetujuiData->PIC,
                'menyetujui' => $pemohonMenyetujuiData->menyetujui,
            ];

            // Mengirim data pemohon dan menyetujui ke tampilan sebagai respons JSON
            return response()->json($data);
        } else {
            // Jika data tidak ditemukan, mengirim respons JSON dengan data kosong
            return response()->json([]);
        }
    }
    public function getDataByPR(Request $request)
    {
        $tipePR = $request->input('tipe_pr');

        $details = DB::table('admin_purchase_request')
            ->join('admin_purchase_request_detail', 'admin_purchase_request.id', '=', 'admin_purchase_request_detail.fk_pr')
            ->where('admin_purchase_request.no_doku', $tipePR)
            ->get();

        if ($details->count() > 0) {
            // Menggabungkan data keterangan, jumlah, dan qty ke dalam satu array
            $keterangan = [];
            $jumlah = [];
            $qty = [];

            foreach ($details as $detail) {
                $keterangan[] = $detail->judul;
                $jumlah[] = $detail->jumlah;
                $qty[] = $detail->satuan;
            }

            $data = [
                'keterangan' => $keterangan,
                'jumlah' => $jumlah,
                'qty' => $qty,
            ];

            // Mengirim data ke tampilan sebagai respons JSON
            return response()->json($data);
        } else {
            // Jika data tidak ditemukan, mengirim respons JSON dengan data kosong
            return response()->json([]);
        }
    }
    public function simpan_PO(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $PO = new Purchase_Order();
        $PO->no_doku = $request->no_doku;
        $PO->tgl_purchasing = $tgl_diajukan;
        $PO->tipe_pr = $request->tipe_pr;
        $PO->supplier = $request->supplier;
        $PO->pemohon = $request->pemohon;
        $PO->accounting = $request->accounting;
        $PO->kasir = $request->kasir;
        $PO->menyetujui = $request->menyetujui;
        $PO->save();

        foreach ($request->ket as $keterangan => $value) {
            $PO_detail = new Purchase_Order_Detail();
            $PO_detail->judul = $value;
            $PO_detail->jumlah = $request->jum[$keterangan];
            $PO_detail->tgl_1 = isset($request->tgl_1[$keterangan]) ? $request->tgl_1[$keterangan] : null;
            $PO_detail->tgl_2 = isset($request->tgl_2[$keterangan]) ? $request->tgl_2[$keterangan] : null;
            $PO_detail->satuan = $request->qty[$keterangan];
            $PO_detail->curr = $request->kurs[$keterangan];
            $PO_detail->nominal = $request->nom[$keterangan];
            $PO_detail->PPN = isset($request->vat[$keterangan]) ? ($request->vat[$keterangan]) : null;
            $PO_detail->PPH = isset($request->pph[$keterangan]) ? ($request->pph[$keterangan]) : null;
            $PO_detail->PPH_4 = isset($request->pph_4[$keterangan]) ? ($request->pph_4[$keterangan]) : null;
            $PO_detail->PPH_21 = isset($request->pph_21[$keterangan]) ? ($request->pph_21[$keterangan]) : null;
            $PO_detail->diskon = isset($request->diskon[$keterangan]) ? ($request->diskon[$keterangan]) : null;
            $PO_detail->ctm_1 = isset($request->lain_lain[$keterangan]) ? ($request->lain_lain[$keterangan]) : null;
            $PO_detail->ctm_2 = isset($request->lain_lain_nom[$keterangan]) ? ($request->lain_lain_nom[$keterangan]) : null;
            $PO_detail->fk_po = $PO->id;

            $PO_detail->save();
        }
        return redirect()->route('direksi.purchase_order')->with('success', 'Data Purchase Order berhasil disimpan.');
    }
}
