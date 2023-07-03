<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\CashAdvanceReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CashAdvanceReportController extends Controller
{
    public function index()
    {
        $title = 'Cash Advance Report';
        $dataCAR = DB::table('admin_cash_advance_report')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->paginate(10);
        return view('halaman_finance.cash_advance_report.index', [
            'title' => $title,
            'cash_advance_report' => $dataCAR
        ]);
    }
    public function view_cash_advance_report($id)
    {
        $title = 'Lihat Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_finance.cash_advance_report.view_cash_advance_report', [
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

        return view('halaman_finance.cash_advance_report.print_cash_advance_report', [
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

        return view('halaman_finance.cash_advance_report.print_bukti_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'bukti_CAR' => $cash_advance_report_detail,
        ]);
    }
    public function excel_cash_advance_report($id)
    {
        return Excel::download(new CashAdvanceReportExport($id), 'CAR_kasir_' . $id . '.xlsx');
    }
    public function bayar_cash_advance_report($id)
    {
        $title = 'Bayar Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->where('id', $id)->first();
        $data_CAR_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_finance.cash_advance_report.bayar_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'CAR_detail' => $data_CAR_detail,
            'nominal' => $nominal_CAR
        ]);
    }
    public function paid_CAR($id, Request $request)
    {
        $data = DB::table('admin_cash_advance')->find($id);
        DB::table('admin_cash_advance')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
}
