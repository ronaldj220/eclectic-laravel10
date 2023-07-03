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
        $RB = DB::table('admin_reimbursement')
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->count();
        $CA = DB::table('admin_cash_advance')
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->count();
        $CAR = DB::table('admin_cash_advance_report')
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->count();
        $PR = DB::table('admin_purchase_request')
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->count();
        $PO = DB::table('admin_purchase_order')
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->count();
        return view('halaman_admin.beranda.index', [
            'title' => $title,
            'RB' => $RB,
            'CA' => $CA,
            'CAR' => $CAR,
            'PR' => $PR,
            'PO' => $PO
        ]);
    }
}
