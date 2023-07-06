<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\CashAdvanceExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Cash_Advance;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class Cash_AdvanceController extends Controller
{
    public function index()
    {
        $title = 'Cash Advance';
        $dataCashAdvance = DB::table('admin_cash_advance')
            ->orderBy('no_doku', 'desc')
            ->paginate(10);
        $dataRBMenyetujui = DB::table('admin_cash_advance')->first();

        return view('halaman_admin.admin.cash_advance.index', [
            'title' => $title,
            'CashAdvance' => $dataCashAdvance,
            'menyetujui' => $dataRBMenyetujui
        ]);
    }
    public function tambah_CA()
    {
        $title = 'Tambah Cash Advance';
        $AWAL = 'CA';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_cash_advance')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        $currentMonth = date('n');
        if (date('j') == 1) {
            $no_dokumen = date('y') . '/' . $bulanRomawi[$currentMonth] . '/' . $AWAL . '/' . sprintf("%05s", abs($no));
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = date('y') . '/' . $bulanRomawi[$currentMonth] . '/' . $AWAL . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
            } else {
                $no_dokumen = date('y') . '/' . $bulanRomawi[$currentMonth] . '/' . $AWAL . '/' . sprintf("%05s", abs($no + 1));
            }
        }
        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::select('SELECT * FROM karyawan');
        return view('halaman_admin.admin.cash_advance.tambah_cash_advance', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan
        ]);
    }
    public function simpan_CA(Request $request)
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
    public function view_CA($id)
    {
        $title = 'Lihat Cash Advance';
        $cash_advance = Cash_Advance::find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        return view('halaman_admin.admin.cash_advance.view_cash_advance', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA
        ]);
    }
    public function setujui_CA($id)
    {
        $data = DB::table('admin_cash_advance')->find($id);
        try {
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $no_doku = $data->no_doku;
            return redirect()->route('admin.cash_advance')->with('success', 'Data dengan no dokumen' . $no_doku . ' Berhasil Diajukan! Mohon Menunggu Kepastian ya... Semoga diterima!');
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance')->with('gagal', $e->getMessage());
        }
    }
    public function print_CA($id)
    {
        $title = 'Cetak Cash Advance';
        $cash_advance = Cash_Advance::find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');

        return view('halaman_admin.admin.cash_advance.print_cash_advance', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA,

        ]);
    }
    public function excel_CA($id)
    {
        return FacadesExcel::download(new CashAdvanceExport($id), 'cash_advance_' . $id . '.xlsx');
    }
    public function edit_CA($id)
    {
        $CA = DB::table('admin_cash_advance')->where('id', $id)->first();
        $title = 'Edit Reimbursement';
        $menyetujui = DB::select('SELECT * from menyetujui');
        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_admin.admin.cash_advance.edit_CA', [
            'title' => $title,
            'CA' => $CA,
            'kurs' => $currency,
            'menyetujui' => $menyetujui
        ]);
    }
    public function update_CA($id, Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');
        $tgl_diajukan2 = isset($request->tgl_diajukan2) ? $request->tgl_diajukan2 : null;

        DB::table('admin_cash_advance')->where('id', $id)
            ->update([
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
        return redirect()->route('admin.cash_advance')->with('success', 'Data Cash Advance Berhasil Diperbarui!');
    }
}
