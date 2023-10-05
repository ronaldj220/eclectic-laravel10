<?php

namespace App\Http\Controllers\Kasir\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportPRController extends Controller
{
    public function index()
    {
        $title = 'Cari Tanggal Dokumen PR';
        return view('halaman_finance.purchase_request.report.index', [
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

        $PR = DB::table('admin_purchase_request as apr')
            ->whereBetween('apr.tgl_diajukan', [$tgl_awal, $tgl_akhir])

            ->select(
                'apr.no_doku as no_doku_PR',
                'apr.tgl_diajukan as tgl_PR',
                'apr.pemohon as pemohon_PR',
                'apr.menyetujui as direksi_PR',
                'aprd.judul as deskripsi_PR',
                'aprd.tgl_1 as tgl_1',
                'aprd.tgl_2 as tgl_2',
                'aprd.jumlah as jumlah_PR',
                'aprd.satuan as satuan',
                'aprd.tgl_pakai as tgl_pakai',
                'aprd.project as project',
            )
            ->join('admin_purchase_request_detail as aprd', 'apr.id', '=', 'aprd.fk_pr')
            ->orderBy('apr.no_doku')
            ->get()
            ->groupBy('no_doku_PR');

        return view('halaman_finance.purchase_request.report.result', [
            'title' => $title,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'PR' => $PR
        ]);
    }
}
