<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\CashAdvanceExports;
use App\Http\Controllers\Controller;
use DateTime;
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
        $kasir = Auth::guard('kasir')->user()->nama;
        $dataCA = DB::table('admin_cash_advance')
            ->where(function ($query) use ($kasir) {
                $query->where('pemohon', $kasir)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($kasir) {
                $query->where('pemohon', $kasir)
                    ->where(function ($query) {
                        $query->where('status_approved', 'rejected')
                            ->orWhere('status_paid', 'rejected');
                    });
            })
            ->orWhere(function ($query) use ($kasir) {
                $query->where('pemohon', $kasir)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($kasir) {
                $query->where('pemohon', '<>', $kasir)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($kasir) {
                $query->where('pemohon', '<>', $kasir)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->where(function ($query) use ($kasir) {
                $query->where('pemohon', $kasir);
            })
            ->orWhere(function ($query) {
                $query->where('status_approved', 'approved')
                    ->where('status_paid', 'pending');
            })
            ->orderBy('no_doku', 'desc')
            ->orderByRaw("CASE WHEN status_approved = 'approved' AND status_paid = 'pending' THEN 0 WHEN status_approved = 'pending' OR status_paid = 'pending' THEN 1 ELSE 2 END, CASE WHEN pemohon = 'Suzy. A' THEN 1 ELSE 2 END")
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
                $no_dokumen = date('y') . '/' . $bulanRomawi[$currentMonth] . '/' . $AWAL . '/' . sprintf("%05s", abs($no));
            }
        }

        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_finance.cash_advance.tambah_CA', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
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
        return redirect()->route('kasir.cash_advance')->with('success', 'Data Cash Advance Berhasil Diajukan!');
    }
}
