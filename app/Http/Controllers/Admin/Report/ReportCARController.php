<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportCARController extends Controller
{
    public function index()
    {
        $title = 'Cari Tanggal Dokumen CAR';

        return view('halaman_admin.admin.cash_advance_report.report.index', [
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
        $CAR = DB::table('admin_cash_advance_report as acar')
            ->select(
                'acar.no_doku as no_doku',
                'acar.tgl_diajukan as tgl_diajukan',
                'acar.judul_doku as judul_doku',
                'acar.tipe_ca as tipe_ca',
                'acar.nominal_ca as nominal_ca',
                'acar.pemohon as pemohon_ca',
                'acar.accounting as acc_ca',
                'acar.kasir as kasir_ca',
                'acar.menyetujui as direksi',
                'acard.deskripsi as CAR_detail',
                'acard.no_bukti as nobu',
                'acard.curr as curr',
                'acard.nominal as nominal_CAR',
                'acard.tanggal_1 as tgl_1',
                'acard.tanggal_2 as tgl_2',
                'acard.keperluan as keperluan',
            )
            ->join('admin_cash_advance_report_detail as acard', 'acar.id', '=', 'acard.fk_ca')
            ->whereBetween('acar.tgl_diajukan', [$tgl_awal, $tgl_akhir])
            ->orderBy('acar.no_doku')
            ->get()
            ->groupBy('no_doku');
        // dd($CAR);

        return view('halaman_admin.admin.cash_advance_report.report.result', [
            'title' => $title,
            'CAR' => $CAR
        ]);
    }
}
