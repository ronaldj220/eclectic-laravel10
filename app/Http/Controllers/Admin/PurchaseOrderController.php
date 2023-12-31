<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\PurchaseOrderExports;
use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Order;
use App\Models\Admin\Purchase_Order_Detail;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $title = 'PO';
        $query = DB::table('admin_purchase_order as a')
            ->select('a.id', 'a.no_doku', 'a.tgl_purchasing', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.supplier', 'a.status_approved', 'a.status_paid')
            ->selectSub(function ($query) {
                $query->select('judul')
                    ->from('admin_purchase_order_detail as d')
                    ->whereColumn('a.id', 'd.fk_po')
                    ->limit(1);
            }, 'judul')
            ->leftJoin('admin_purchase_request as b', 'a.tipe_pr', '=', 'b.no_doku')
            ->orderBy('tgl_purchasing', 'desc')
            ->orderBy('no_doku', 'desc');
        if ($request->has('search')) {
            $dataPO = $query->where('a.supplier', 'LIKE', '%' . $request->search . '%')
                ->paginate(20);
        } elseif ($request->has('bulan')) {
            $bulan = $request->bulan;
            $query->whereMonth('tgl_purchasing', date('m', strtotime($bulan)))
                ->whereYear('tgl_purchasing', date('Y', strtotime($bulan)));
            $dataPO = $query->paginate(100);
        } else {
            $dataPO = $query->paginate(20);
        }


        return view('halaman_admin.admin.purchase_order.index', [
            'title' => $title,
            'PO' => $dataPO
        ]);
    }
    public function tambah_PO()
    {
        $title = 'Tambah PO';
        $AWAL = 'PO';

        $bulanRomawi = array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $noUrutAkhir = DB::table('admin_purchase_order')->whereMonth('tgl_purchasing', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if ($noUrutAkhir) {
            $no_dokumen = sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        } else {
            $no_dokumen = sprintf("%02s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        }
        $tipe_pr = DB::select('
        SELECT pr.no_doku
        FROM admin_purchase_request pr
        WHERE pr.no_doku NOT IN (SELECT po.tipe_pr FROM admin_purchase_order po)
        ');
        $pemohon = DB::table('karyawan')
            ->select('nama')
            ->union(DB::table('menyetujui')->select('nama'))
            ->union(DB::table('kasir')->select('nama'))
            ->orderBy('nama')
            ->get();
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

        $supplier = DB::select('SELECT * FROM supplier ORDER by nama_supplier ASC');

        $fee = DB::table('master_po')->first();
        return view('halaman_admin.admin.purchase_order.tambah_purchase_order', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'pemohon' => $pemohon,
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
            $tgl_1 = [];
            $tgl_2 = [];

            foreach ($details as $detail) {
                $keterangan[] = $detail->judul;
                $jumlah[] = $detail->jumlah;
                $qty[] = $detail->satuan;
                $tgl_1[] = $detail->tgl_1;
                $tgl_2[] = $detail->tgl_2;
            }

            $data = [
                'keterangan' => $keterangan,
                'jumlah' => $jumlah,
                'qty' => $qty,
                'tgl_1' => $tgl_1,
                'tgl_2' => $tgl_2,
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
            $PO_detail->tgl_1 = $request->tgl_1[$keterangan];
            $PO_detail->tgl_2 = $request->tgl_2[$keterangan];

            $PO_detail->fk_po = $PO->id;

            $PO_detail->save();
        }
        return redirect()->route('admin.purchase_order')->with('success', 'Data Purchase Order berhasil disimpan.');
    }
    public function excel_PO($id)
    {
        return Excel::download(new PurchaseOrderExports($id), 'PO_Admin_' . $id . '.xlsx');
    }
    public function print_PO($id)
    {
        $title = 'Cetak Purchase Order';
        $PO = DB::table('admin_purchase_order')->find($id);
        $PO_Nominal = DB::table('admin_purchase_order')->where('id', $id)->get();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $results = [];
        foreach ($PO_Nominal as $item) {
            $result = ($item->PPN / 100) * $nominal_PO;
            $PPH = ($item->PPH / 100) * $nominal_PO;
            $PPH_21 = ($item->PPH_21 / 100) * $nominal_PO;
            $PPH_4 = ($item->PPH_4 / 100) * $nominal_PO;
            $ctm_2 = ($item->ctm_2 / 100) * $nominal_PO;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH - $PPH_4 - $PPH_21 - $ctm_2;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');
        return view('halaman_admin.admin.purchase_order.print_purchase_order', [
            'title' => $title,
            'PO' => $PO,
            'PO_detail' => $PO_detail,
            'nominal' => $nominal_PO,
            'PPN' => $result,
            'PPH' => $PPH,
            'PPH_4' => $PPH_4,
            'PPH_21' => $PPH_21,
            'ctm_2' => $ctm_2,
            'grand_total' => $grand_total,
            'tgl_purchasing' => $formattedDate
        ]);
    }
    public function view_PO($id)
    {
        $title = 'Lihat PO';
        $PO = DB::table('admin_purchase_order')->find($id);
        $PO_Nominal = DB::table('admin_purchase_order')->where('id', $id)->get();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $results = [];
        foreach ($PO_Nominal as $item) {
            $result = ($item->PPN / 100) * $nominal_PO;
            $PPH = ($item->PPH / 100) * $nominal_PO;
            $PPH_4 = ($item->PPH_4 / 100) * $nominal_PO;
            $PPH_21 = ($item->PPH_21 / 100) * $nominal_PO;
            $diskon = ($item->diskon) * $nominal_PO;
            $ctm_2 = ($item->ctm_2 / 100) * $nominal_PO;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH - $PPH_4 - $PPH_21 - $ctm_2;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');
        return view('halaman_admin.admin.purchase_order.view_PO', [
            'title' => $title,
            'PO' => $PO,
            'PO_detail' => $PO_detail,
            'nominal' => $nominal_PO,
            'PPN' => $result,
            'PPH' => $PPH,
            'PPH_4' => $PPH_4,
            'PPH_21' => $PPH_21,
            'diskon' => $diskon,
            'ctm_2' => $ctm_2,
            'grand_total' => $grand_total,
            'tgl_purchasing' => $formattedDate
        ]);
    }
    public function view_PR($id)
    {
        $title = 'Lihat PR';
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_admin.admin.purchase_order.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function setujui_PO($id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.purchase_order')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan! Mohon Menunggu Persetujuan dari Direktur!');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase_order')->with('gagal', $e->getMessage());
        }
    }
    public function acc_PO($id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.purchase_order')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase_order')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_PO($id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.purchase_order')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui! Mohon Ajukan Dokumen yang Berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase_order')->with('gagal', $e->getMessage());
        }
    }
    public function edit_PO($id)
    {
        $title = 'Edit Purchase Order';
        $PO = DB::table('admin_purchase_order')->where('id', $id)->first();
        $menyetujui = DB::select('SELECT * from menyetujui');
        $tipe_pr = DB::select('SELECT * FROM admin_purchase_request');
        $supplier = DB::select('SELECT * FROM supplier');
        $kurs = DB::select('SELECT * FROM kurs');

        return view('halaman_admin.admin.purchase_order.edit_PO', [
            'title' => $title,
            'PO' => $PO,
            'menyetujui' => $menyetujui,
            'tipe_pr' => $tipe_pr,
            'supplier' => $supplier,
            'kurs' => $kurs
        ]);
    }
    public function update_PO(Request $request, $id)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        DB::table('admin_purchase_order')->where('id', $id)->update([
            'no_doku' => $request->no_doku,
            'tgl_purchasing' => $tgl_diajukan,
            'tipe_pr' => $request->tipe_pr,
            'supplier' => $request->supplier,
            'pemohon' => $request->pemohon,
            'accounting' => $request->accounting,
            'kasir' => $request->kasir,
            'menyetujui' => $request->menyetujui
        ]);

        foreach ($request->ket as $keterangan => $value) {
            DB::table('admin_purchase_order_detail')->where('fk_po', $id)->update([
                'judul' => $value,
                'jumlah' => $request->jum[$keterangan],
                'satuan' => $request->qty[$keterangan],
                'curr' => $request->kurs[$keterangan],
                'nominal' => $request->nom[$keterangan],
                'PPN' => isset($request->vat[$keterangan]) ? ($request->vat[$keterangan]) : null,
                'PPH' => isset($request->pph[$keterangan]) ? ($request->pph[$keterangan]) : null,
                'PPH_4' => isset($request->pph_4[$keterangan]) ? ($request->pph_4[$keterangan]) : null,
                'PPH_21' => isset($request->pph_21[$keterangan]) ? ($request->pph_21[$keterangan]) : null,
                'diskon' => isset($request->diskon[$keterangan]) ? ($request->diskon[$keterangan]) : null,
                'ctm_1' => isset($request->lain_lain[$keterangan]) ? ($request->lain_lain[$keterangan]) : null,
                'ctm_2' =>  isset($request->lain_lain_nom[$keterangan]) ? ($request->lain_lain_nom[$keterangan]) : null,
                'fk_po' => $id
            ]);
        }
        return redirect()->route('admin.purchase_order')->with('success', 'Data Purchase Order berhasil diperbarui.');
    }

    public function hapus_PO($id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->delete();
            DB::table('admin_purchase_order_detail')->where('fk_po', $id)->delete();

            return redirect()->route('admin.purchase_order')->with('success', 'Data Purchase Order berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Tangani jika terjadi kesalahan
            return redirect()->route('admin.purchase_order')->with('error', $e->getMessage());
        }
    }
}
