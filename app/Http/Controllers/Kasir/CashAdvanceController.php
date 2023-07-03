<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\CashAdvanceExports;
use App\Http\Controllers\Controller;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $title = 'Cash Advance';
        $dataCA = DB::table('admin_cash_advance')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->paginate(10);
        return view('halaman_finance.cash_advance.index', [
            'title' => $title,
            'cash_advance' => $dataCA
        ]);
    }
    public function view_cash_advance($id)
    {
        $title = 'Lihat Cash Advance';
        $cashadvance = DB::table('admin_cash_advance')->find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        // $namaKaryawan = Auth::user()->nama;
        // $dataKaryawan = DB::table('karyawan')->where('nama', $namaKaryawan)->select('nama', 'bank', 'no_rekening', 'signature')->first();
        // $namaMenyetujui = Auth::guard('direksi')->user()->nama;
        // $direksi = DB::table('menyetujui AS m')
        //     ->join('admin_cash_advance AS a', 'm.nama', '=', 'a.menyetujui')
        //     ->select('m.nama', 'm.signature')
        //     ->where('m.nama', $namaMenyetujui)
        //     ->get();
        return view('halaman_finance.cash_advance.view_cash_advance', [
            'title' => $title,
            'cash_advance' => $cashadvance,
            'nominal' => $nominal_CA,

        ]);
    }
    public function print_cash_advance($id)
    {
        $title = 'Cetak Cash Advance';
        $cashadvance = DB::table('admin_cash_advance')->find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        // $namaKaryawan = Auth::guard('karyawan')->user()->nama;
        // $dataKaryawan = DB::table('karyawan')->where('nama', $namaKaryawan)->select('nama', 'bank', 'no_rekening', 'signature')->first();
        // $namaMenyetujui = Auth::guard('direksi')->user()->nama;
        // $direksi = DB::table('menyetujui AS m')
        //     ->join('admin_reimbursement AS a', 'm.nama', '=', 'a.menyetujui')
        //     ->select('m.nama', 'm.signature')
        //     ->where('m.nama', $namaMenyetujui)
        //     ->get();

        // $dataUser = DB::table('users')->select('no_rekening', 'bank', 'nama')->first();


        return view('halaman_finance.cash_advance.print_cash_advance', [
            'title' => $title,
            'cash_advance' => $cashadvance,
            'nominal' => $nominal_CA,
        ]);
    }
    public function excel_cash_advance($id)
    {
        return Excel::download(new CashAdvanceExports($id), 'cash_advance_kasir_' . $id . '.xlsx');
    }
    public function bayar_cash_advance($id)
    {
        $title = 'Bayar Cash Advance';
        $cash_advance = DB::table('admin_cash_advance')->where('id', $id)->first();
        $nominal = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');


        return view('halaman_finance.cash_advance.bayar_cash_advance', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal,
        ]);
    }
    public function paid_CA(Request $request, $id)
    {
        $data = DB::table('admin_cash_advance')->find($id);
        DB::table('admin_cash_advance')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.cash_advance')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
}
