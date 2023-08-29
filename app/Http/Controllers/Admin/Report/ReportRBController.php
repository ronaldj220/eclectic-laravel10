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
            ->leftJoin('admin_rb_detail as rbd', 'ar.id', '=', 'rbd.fk_rb')
            ->leftJoin('admin_timesheet_project_detail as atpd', 'ar.id', '=', 'atpd.fk_timesheet_project')
            ->leftJoin('admin_support_ticket_detail as astd', 'ar.id', '=', 'astd.fk_support_ticket')
            ->leftJoin('admin_support_lembur_detail as asld', 'ar.id', '=', 'asld.fk_support_lembur')
            ->whereBetween('ar.tgl_diajukan', [$tgl_awal, $tgl_akhir])
            ->select(
                'ar.no_doku_real',
                'ar.tgl_diajukan',
                'ar.halaman',
                'ar.judul_doku',
                'ar.pemohon',
                'ar.accounting',
                'ar.kasir',
                'ar.menyetujui',
                'rbd.deskripsi',
                'rbd.tanggal_1',
                'rbd.tanggal_2',
                'rbd.keperluan',
                'rbd.no_bukti',
                'rbd.curr',
                'rbd.nominal as nominal',
                // Timesheet Project
                'atpd.nama_karyawan as nama_TS',
                'atpd.hari as hari_TS',
                'rbd.curr as curr_TS',
                DB::raw('
                    CASE
                        WHEN atpd.hari >= 19 THEN atpd.nominal_awal
                        ELSE (atpd.nominal_awal / atpd.hari_awal) * atpd.hari
                    END as nominal_ts'),
                // ...
                // Support Ticket
                'astd.nama_karyawan as nama_ST',
                'astd.aliases as project_ST',
                'astd.jam as jam_ST',
                'rbd.curr as curr_ST',
                DB::raw('astd.nominal_awal * astd.jam as nominal_astd'),
                // Support Lembur
                'asld.nama_karyawan as nama_SL',
                'asld.aliases as project_SL',
                'asld.jam as jam_SL',
                'rbd.curr as curr_SL',
                DB::raw('asld.nominal_awal * asld.jam as nominal_asld')
            )
            ->orderBy('ar.no_doku_real')
            ->get()
            ->groupBy('no_doku_real');

        // dd($reimbursements);
        $nominal = DB::table('admin_reimbursement as ar')
            ->join('admin_rb_detail as rbd', 'ar.id', '=', 'rbd.fk_rb')
            ->whereBetween('ar.tgl_diajukan', [$tgl_awal, $tgl_akhir])
            ->orderBy('ar.no_doku_real', 'desc') // Urutkan dari yang terbaru
            ->select(DB::raw('SUM(rbd.nominal) as total_nominal'))
            ->groupBy('ar.no_doku_real')
            ->get(); // Ambil baris pertama dari hasil query

        $totalNominals = [];

        foreach ($reimbursements as $noDokuReal => $group) {
            $totalNominal = $group->sum('nominal'); // Asumsi field untuk nominal adalah 'nominal'
            $totalNominals[$noDokuReal] = $totalNominal;
        }
        return view('halaman_admin.admin.reimbursement.report.result', [
            'title' => $title,
            'reimbursements' => $reimbursements,
            'nominal' => $totalNominals,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }
}
