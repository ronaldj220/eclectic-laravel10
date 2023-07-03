<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashAdvanceReportController extends Controller
{
    public function index()
    {
        $title = 'Cash Advance Report';
        $datacashadvancereport = DB::table('admin_cash_advance_report')
            ->orderByDesc('no_doku')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        return view('halaman_direksi.cash_advance_report.index', [
            'title' => $title,
            'cash_advance_report' => $datacashadvancereport
        ]);
    }
    public function view_cash_advance_report($id)
    {
        $title = 'Lihat Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_direksi.cash_advance_report.view_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'data_CAR' => $cash_advance_report_detail,
            'nominal' => $nominal_CAR
        ]);
    }
    public function print_cash_advance_report($id)
    {
        $title = 'Cetak Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_direksi.cash_advance_report.print_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'data_CAR' => $cash_advance_report_detail,
            'nominal' => $nominal_CAR
        ]);
    }
    public function print_bukti_cash_advance_report($id)
    {
        $title = 'Cetak Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();

        return view('halaman_direksi.cash_advance_report.print_bukti_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'bukti_CAR' => $cash_advance_report_detail,
        ]);
    }
    public function setujui_cash_advance_report($id)
    {
        try {
            $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
            DB::table('admin_cash_advance_report')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
                'tgl_persetujuan' => Carbon::now()
            ]);
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui. Tunggu Pembayaran ya!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_cash_advance_report(Request $request, $id)
    {
        try {
            $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
            DB::table('admin_cash_advance_report')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.cash_advance_report')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CAR yang baru!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
}
