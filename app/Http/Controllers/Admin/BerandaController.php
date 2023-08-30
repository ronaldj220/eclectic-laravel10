<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $reimbursementQuery = DB::table('admin_reimbursement')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'reimbursement' as source"))
            ->whereIn('status_approved', ['rejected'])
            ->whereIn('status_paid', ['rejected']);

        $cashAdvanceQuery = DB::table('admin_cash_advance')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance' as source"))
            ->whereIn('status_approved', ['rejected'])
            ->whereIn('status_paid', ['rejected']);

        $cashAdvanceReportQuery = DB::table('admin_cash_advance_report')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance_report' as source"))
            ->whereIn('status_approved', ['rejected'])
            ->whereIn('status_paid', ['rejected']);

        $purchaseRequestQuery = DB::table('admin_purchase_request')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'purchase_request' as source"))
            ->whereIn('status_approved', ['rejected'])
            ->whereIn('status_paid', ['rejected']);

        $purchaseOrderQuery = DB::table('admin_purchase_order')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'purchase_order' as source"))
            ->whereIn('status_approved', ['rejected'])
            ->whereIn('status_paid', ['rejected']);

        $combinedData = $reimbursementQuery
            ->union($cashAdvanceQuery)
            ->union($cashAdvanceReportQuery)
            ->union($purchaseRequestQuery)
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

        return view('halaman_admin.beranda.index', [
            'title' => $title,
            'combinedData' => $pagination
        ]);
    }
}
