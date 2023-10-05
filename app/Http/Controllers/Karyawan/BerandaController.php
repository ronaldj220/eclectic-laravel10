<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $authId = Auth::user()->nama;
        // dd($authId);
        $dataReimbursement = DB::table('admin_reimbursement')
            ->where('pemohon', $authId)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataCA = DB::table('admin_cash_advance')
            ->where('pemohon', $authId)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataCAR = DB::table('admin_cash_advance_report')
            ->where('pemohon', $authId)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataPR = DB::table('admin_purchase_request')
            ->where('pemohon', $authId)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        $dataPO = DB::table('admin_purchase_order')
            ->where('pemohon', $authId)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        return view('halaman_karyawan.karyawan.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement,
            'CA' => $dataCA,
            'CAR' => $dataCAR,
            'PR' => $dataPR,
            'PO' => $dataPO
        ]);
    }
    public function profile()
    {
        $title = 'Profile Karyawan';
        return view('halaman_karyawan.karyawan.profile', [
            'title' => $title
        ]);
    }
    public function update_profile()
    {
        $title = 'Update Profile Karyawan';
        return view('halaman_karyawan.karyawan.update_profile', [
            'title' => $title
        ]);
    }
    public function update_profile_karyawan(Request $request, $id)
    {

        $image_parts = explode(";base64,", $request->input('signature'));
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = 'TTD_' . date('YmdHis') . '.' . $image_type;

        $filePath = 'signatures/' . $filename;
        $fullFilePath = public_path($filePath);
        // Simpan file dalam direktori public
        file_put_contents($fullFilePath, $image_base64);
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank,
            'ttd' => $filename
        ];
        // dd($data);
        User::where('id', $id)->update($data);
        return redirect()->route('karyawan.beranda')->with('success', 'Karyawan Berhasil Diperbarui!');
    }
}
