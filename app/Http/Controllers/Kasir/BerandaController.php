<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $dataReimbursement = DB::table('admin_reimbursement')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataCA = DB::table('admin_cash_advance')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataCAR = DB::table('admin_cash_advance_report')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataPR = DB::table('admin_purchase_request')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataPO = DB::table('admin_purchase_order')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);

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
            'reimbursement' => $dataReimbursement,
            'CA' => $dataCA,
            'CAR' => $dataCAR,
            'PR' => $dataPR,
            'PO' => $dataPO,
            'dataRB' => $RB,
            'dataCA' => $CA,
            'dataCAR' => $CAR,
            'dataPR' => $PR,
            'dataPO' => $PO
        ]);
    }
}
