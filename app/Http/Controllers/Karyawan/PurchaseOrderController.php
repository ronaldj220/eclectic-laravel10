<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Order;
use App\Models\Admin\Purchase_Order_Detail;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Purchase Order';
        $karyawan = Auth::user()->nama;
        if ($request->has('search')) {
            $data_PO = DB::table('admin_purchase_order')
                ->where('supplier', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tgl_purchasing', 'desc')
                ->orderBy('no_doku', 'desc')
                ->paginate(20);
        }
        $data_PO = DB::table('admin_purchase_order')
            ->where('pemohon', $karyawan)
            ->orderBy('no_doku', 'asc')
            ->paginate(10);
        return view('halaman_karyawan.purchase_order.index', [
            'title' => $title,
            'PO' => $data_PO
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

        return view('halaman_karyawan.purchase_order.view_PO', [
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
        $karyawan = Auth::user()->nama;
        $tipe_pr = DB::select('SELECT * FROM admin_purchase_request WHERE pemohon = ?', [$karyawan]);
        $accounting = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 2)
            ->get();
        $kasir = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 3)
            ->get();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->get();
        $kurs = DB::select('SELECT * FROM kurs');

        $supplier = DB::select('SELECT * FROM supplier WHERE PIC = ?', [$karyawan]);

        $fee = DB::table('master_po')->first();

        return view('halaman_karyawan.purchase_order.tambah_PO', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'tipe_pr' => $tipe_pr,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $kurs,
            'supplier' => $supplier,
            'fee' => $fee
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
                'pemilik_bank' => $pemohonMenyetujuiData->pemilik_bank,
                'bank' => $pemohonMenyetujuiData->bank,
                'no_rekening' => $pemohonMenyetujuiData->no_rekening,
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
        $PO->pemilik_bank = $request->pemilik_bank;
        $PO->nama_bank = $request->bank;
        $PO->no_rekening = $request->no_rek;
        $PO->accounting = $request->accounting;
        $PO->kasir = $request->kasir;
        $PO->menyetujui = $request->menyetujui;
        $PO->PPN = isset($request->vat) ? ($request->vat) : null;
        $PO->PPH = isset($request->pph) ? ($request->pph) : null;
        $PO->PPH_4 = isset($request->pph_4) ? ($request->pph_4) : null;
        $PO->PPH_21 = isset($request->pph_21) ? ($request->pph_21) : null;
        $PO->diskon = isset($request->diskon) ? ($request->diskon) : null;
        $PO->ctm_1 = isset($request->lain_lain) ? ($request->lain_lain) : null;
        $PO->ctm_2 = isset($request->lain_lain_nom) ? ($request->lain_lain_nom) : null;

        $PO->save();

        foreach ($request->ket as $keterangan => $value) {
            $PO_detail = new Purchase_Order_Detail();
            $PO_detail->judul = $value;
            $PO_detail->jumlah = $request->jum[$keterangan];
            $PO_detail->satuan = $request->qty[$keterangan];
            $PO_detail->curr = $request->kurs[$keterangan];
            $PO_detail->nominal = $request->nom[$keterangan];
            $PO_detail->fk_po = $PO->id;

            $PO_detail->save();
        }
        return redirect()->route('karyawan.purchase_order')->with('success', 'Data Purchase Order berhasil disimpan.');
    }
}
