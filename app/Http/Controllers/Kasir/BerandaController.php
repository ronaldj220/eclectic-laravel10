<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        // dd(Auth::user()->nama);
        $reimbursementQuery = DB::table('admin_reimbursement')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'reimbursement' as source"))
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending']);

        $cashAdvanceQuery = DB::table('admin_cash_advance')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance' as source"))
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending']);

        $cashAdvanceReportQuery = DB::table('admin_cash_advance_report')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance_report' as source"))
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending']);

        $purchaseOrderQuery = DB::table('admin_purchase_order')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'purchase_order' as source"))
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending']);

        $combinedData = $reimbursementQuery
            ->union($cashAdvanceQuery)
            ->union($cashAdvanceReportQuery)
            ->union($purchaseOrderQuery)
            ->orderBy('no_doku', 'desc')
            ->get();

        // Manual pagination
        $perPage = 10; // Jumlah item per halaman
        $currentPage = request()->get('page', 1); // Ambil nomor halaman dari query string

        // Ambil data untuk halaman saat ini
        $currentPageData = collect($combinedData)->forPage($currentPage, $perPage);

        // Buat pagination
        $pagination = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageData,
            count($combinedData),
            $perPage,
            $currentPage,
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), // Untuk mengambil path URL yang benar
                'query' => request()->query(), // Untuk mempertahankan query string saat pindah halaman
            ]
        );
        $RB = DB::table('admin_reimbursement')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->count();
        $CA = DB::table('admin_cash_advance')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->count();
        $CAR = DB::table('admin_cash_advance_report')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->count();
        $PR = DB::table('admin_purchase_request')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->count();
        $PO = DB::table('admin_purchase_order')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->count();
        return view('halaman_finance.finance.index', [
            'title' => $title,
            'combinedData' => $pagination,
            'dataRB' => $RB,
            'dataCA' => $CA,
            'dataCAR' => $CAR,
            'dataPR' => $PR,
            'dataPO' => $PO
        ]);
    }
    public function profile()
    {
        $title = 'Profil Finance';
        return view('halaman_finance.finance.profile', [
            'title' => $title
        ]);
    }
    public function update_profile(Request $request, $id)
    {
        try {
            DB::table('karyawan')->where('id', $id)->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nama' => $request->nama,
                'no_rekening' => $request->no_rekening,
                'bank' => $request->bank,
            ]);
            return redirect()->route('kasir.beranda')->with('success', 'Profile Finance Berhasil Diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('kasir.beranda')->with('gagal', $e->getMessage());
        }
    }
}
