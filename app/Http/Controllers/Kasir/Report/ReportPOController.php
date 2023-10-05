<?php

namespace App\Http\Controllers\Kasir\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportPOController extends Controller
{
    public function index()
    {
        $title = 'Cari Tanggal Dokumen PO';

        return view('halaman_finance.purchase_order.report.index', [
            'title' => $title
        ]);
    }
    public function search_date(Request $request)
    {
        $title = 'Hasil Pencarian';
        $request->validate([
            'tgl_1' => 'required|date',
            'tgl_2' => 'required|date'
        ], [
            'tgl_1.required' => 'Tanggal 1 Harus Diisi!',
            'tgl_2.required' => 'Tanggal 2 Harus Diisi!'
        ]);
        $tgl_awal = $request->input('tgl_1');
        $tgl_akhir = $request->input('tgl_2');
        $PO = DB::table('admin_purchase_order as apo')
            ->whereBetween('apo.tgl_purchasing', [$tgl_awal, $tgl_akhir])

            ->select(
                'apo.no_doku as no_doku_PO',
                'apo.tgl_purchasing as tgl_purchasing',
                'apo.supplier as supplier',
                'apo.pemohon as pemohon',
                'apo.accounting as acc',
                'apo.kasir as kasir',
                'apo.menyetujui as menyetujui',
                'apo.PPN as PPN',
                'apo.PPH as PPH',
                'apo.PPH_4 as PPH_4',
                'apo.ctm_1 as ctm_1',
                'apo.ctm_2 as ctm_2',
                'apod.judul as judul_PO',
                'apod.tgl_1 as tgl_1',
                'apod.tgl_2 as tgl_2',
                'apod.jumlah as jumlah',
                'apod.satuan as satuan',
                'apod.curr as curr',
                'apod.nominal as nominal_PO',
            )
            ->join('admin_purchase_order_detail as apod', 'apo.id', '=', 'apod.fk_po')
            ->orderBy('no_doku_PO')
            ->get()
            ->groupBy('no_doku_PO');
        return view('halaman_finance.purchase_order.report.result', [
            'title' => $title,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'PO' => $PO

        ]);
    }
}
