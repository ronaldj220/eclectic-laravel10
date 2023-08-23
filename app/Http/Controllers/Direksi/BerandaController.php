<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $menyetujui = Auth::guard('direksi')->user()->nama;
        $dataReimbursement = DB::table('admin_reimbursement')
            ->orderBy('no_doku_real', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->where('menyetujui', $menyetujui)
            ->paginate(10);
        $dataCA = DB::table('admin_cash_advance')
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->where('menyetujui', $menyetujui)
            ->paginate(10);
        $dataCAR = DB::table('admin_cash_advance_report')
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->where('menyetujui', $menyetujui)
            ->paginate(10);
        $dataPR = DB::table('admin_purchase_request')
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->where('menyetujui', $menyetujui)
            ->paginate(10);
        $dataPO = DB::table('admin_purchase_order')
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->where('menyetujui', $menyetujui)
            ->paginate(10);

        $RB = DB::table('admin_reimbursement')
            ->where('status_approved', 'pending')
            ->where('status_paid', 'pending')
            ->where('menyetujui', $menyetujui)
            ->count();
        $CA = DB::table('admin_cash_advance')
            ->where('status_approved', 'pending')
            ->where('status_paid', 'pending')
            ->where('menyetujui', $menyetujui)
            ->count();
        $CAR = DB::table('admin_cash_advance_report')
            ->where('status_approved', 'pending')
            ->where('status_paid', 'pending')
            ->where('menyetujui', $menyetujui)
            ->count();
        $PR = DB::table('admin_purchase_request')
            ->where('status_approved', 'pending')
            ->where('status_paid', 'pending')
            ->where('menyetujui', $menyetujui)
            ->count();
        $PO = DB::table('admin_purchase_order')
            ->where('status_approved', 'pending')
            ->where('status_paid', 'pending')
            ->where('menyetujui', $menyetujui)

            ->count();
        return view('halaman_direksi.direksi.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement,
            'dataCA' => $dataCA,
            'dataCAR' => $dataCAR,
            'dataPR' => $dataPR,
            'dataPO' => $dataPO,
            'RB' => $RB,
            'CA' => $CA,
            'CAR' => $CAR,
            'PR' => $PR,
            'PO' => $PO
        ]);
    }
    public function profile()
    {
        $title = 'Profil Direksi';
        return view('halaman_direksi.direksi.profile', [
            'title' => $title
        ]);
    }
    public function update_profile(Request $request, $id)
    {
        DB::table('menyetujui')->where('id', $id)->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'no_telp' => $request->no_telp,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank
        ]);

        return redirect()->route('direksi.beranda')->with('success', 'Profil Direksi Berhasil Diperbarui!');
    }
}
