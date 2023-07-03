<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $title = 'Cash Advance';
        $datacashadvance = DB::table('admin_cash_advance')
            ->orderByDesc('no_doku')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        return view('halaman_direksi.cash_advance.index', [
            'title' => $title,
            'cash_advance' => $datacashadvance
        ]);
    }
    public function view_cash_advance($id)
    {
        $title = 'Lihat Cash Advance';
        $cashadvance = DB::table('admin_cash_advance')->find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        $namaKaryawan = Auth::user()->nama;
        $dataKaryawan = DB::table('karyawan')->where('nama', $namaKaryawan)->select('nama', 'bank', 'no_rekening', 'signature')->first();
        $namaMenyetujui = Auth::guard('direksi')->user()->nama;
        $direksi = DB::table('menyetujui AS m')
            ->join('admin_cash_advance AS a', 'm.nama', '=', 'a.menyetujui')
            ->select('m.nama', 'm.signature')
            ->where('m.nama', $namaMenyetujui)
            ->get();
        return view('halaman_direksi.cash_advance.view_cash_advance', [
            'title' => $title,
            'cash_advance' => $cashadvance,
            'nominal' => $nominal_CA,
            'karyawan' => $dataKaryawan,
            'direksi' => $direksi
        ]);
    }
    public function setujui_cash_advance($id)
    {
        try {
            $data = DB::table('admin_cash_advance')->where('id', $id)->first();
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
                'tgl_approval' => Carbon::now()
            ]);
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.cash_advance')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui. Tunggu Pembayaran ya!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance')->with('gagal', $e->getMessage());
        }
    }
    public function print_cash_advance($id)
    {
        $title = 'Cetak Cash Advance';
        $cashadvance = DB::table('admin_cash_advance')->find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        return view('halaman_direksi.cash_advance.print_cash_advance', [
            'title' => $title,
            'cash_advance' => $cashadvance,
            'nominal' => $nominal_CA
        ]);
    }
    public function tolak_cash_advance($id, Request $request)
    {
        try {
            $data = DB::table('admin_cash_advance')->where('id', $id)->first();
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.cash_advance')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CA yang baru!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance')->with('gagal', $e->getMessage());
        }
    }
}
