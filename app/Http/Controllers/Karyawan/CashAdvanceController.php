<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $title = 'Cash Advance';
        $authId = Auth::guard('karyawan')->user()->nama;
        $dataCashAdvance = DB::table('admin_cash_advance')
            ->where('pemohon', $authId)
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->paginate(10);
        $dataRBMenyetujui = DB::table('admin_cash_advance')->first();
        return view('halaman_karyawan.cash_advance.index', [
            'title' => $title,
            'CashAdvance' => $dataCashAdvance,
            'menyetujui' => $dataRBMenyetujui
        ]);
    }
    public function tambah_cash_advance()
    {
        $title = 'Tambah Cash Advance';
        $AWAL = 'CA';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrut = DB::table('admin_cash_advance')->max('id');
        $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($noUrut + 1));
        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_karyawan.cash_advance.tambah_cash_advance', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
        ]);
    }
    public function simpan_cash_advance(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');
        $tgl_diajukan2 = isset($request->tgl_diajukan2) ? $request->tgl_diajukan2 : null;

        DB::table('admin_cash_advance')->insert([
            'no_doku' => $request->no_doku,
            'tgl_diajukan' => $tgl_diajukan,
            'tgl_diajukan2' => $tgl_diajukan2,
            'judul_doku' => $request->judul_doku,
            'curr' => $request->kurs,
            'nominal' => $request->nominal,
            'pemohon' => $request->pemohon,
            'accounting' => $request->accounting,
            'kasir' => $request->kasir,
            'menyetujui' => $request->nama_menyetujui
        ]);
        return redirect()->route('admin.cash_advance')->with('success', 'Data Cash Advance Berhasil Diajukan!');
    }

    public function view_cash_advance($id)
    {
        $title = 'Lihat Cash Advance';
        $cash_advance = DB::table('admin_cash_advance')->find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');

        return view('halaman_karyawan.cash_advance.view_CA', [
            'title' => $title,
            'CA' => $cash_advance,
            'nominal' => $nominal_CA
        ]);
    }
}
