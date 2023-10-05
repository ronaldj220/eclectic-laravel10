<?php

namespace App\Http\Controllers\Kasir\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportCAController extends Controller
{
    public function index()
    {
        $title = 'Cari Tanggal Dokumen CA';

        return view('halaman_finance.cash_advance.report.inde', [
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
        // dd($tgl_akhir);
        $CA = DB::table('admin_cash_advance')->whereBetween('tgl_diajukan', [$tgl_awal, $tgl_akhir])
            ->orderBy('no_doku', 'asc')
            ->get();

        // dd($CA);

        return view('halaman_finance.cash_advance.report.result', [
            'title' => $title,
            'CA' => $CA,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }
}
