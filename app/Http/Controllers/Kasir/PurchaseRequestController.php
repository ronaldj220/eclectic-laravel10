<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $title = 'Purchase Request';
        $dataPR = DB::table('admin_purchase_request')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        return view('halaman_finance.purchase_request.index', [
            'title' => $title,
            'PR' => $dataPR
        ]);
    }
    public function view_PR($id)
    {
        $title = 'Lihat Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_request.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function print_PR($id)
    {
        $title = 'Cetak Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_request.print_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function bayar_PR($id)
    {
        $title = 'Bayar Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_request.bayar_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function paid_PR($id, Request $request)
    {
        $data = DB::table('admin_purchase_request')->find($id);
        DB::table('admin_purchase_request')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.purchase_request')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
}
