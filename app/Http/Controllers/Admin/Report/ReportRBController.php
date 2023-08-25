<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportRBController extends Controller
{
    public function index()
    {
        $title = 'Cari Tanggal Dokumen RB';
        return view('halaman_admin.admin.reimbursement.report.index', [
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

        $reimbursements = DB::table('admin_reimbursement as ar')
            ->join('admin_rb_detail as rbd', 'ar.id', '=', 'rbd.fk_rb')
            ->whereBetween('ar.tgl_diajukan', [$tgl_awal, $tgl_akhir])
            ->orderBy('ar.no_doku_real')
            ->get()
            ->groupBy('no_doku_real'); // Mengelompokkan berdasarkan no_doku_real

        // dd($reimbursements);
        return view('halaman_admin.admin.reimbursement.report.result', [
            'title' => $title,
            'reimbursement' => $reimbursements,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }
}
