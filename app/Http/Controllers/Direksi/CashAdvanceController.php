<?php

namespace App\Http\Controllers\Direksi;

use App\Exports\Admin\CashAdvanceReport;
use App\Http\Controllers\Controller;
use App\Models\Admin\CashAdvanceReport as AdminCashAdvanceReport;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CashAdvanceController extends Controller
{
    public function index()
    {
        $title = 'CA';
        $menyetujui = Auth::user()->nama;
        $datacashadvance = DB::table('admin_cash_advance')
            ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
            ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
            ->where('admin_cash_advance.pemohon', $menyetujui)
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('admin_cash_advance.status_approved', 'pending')
                    ->where('admin_cash_advance.status_paid', 'pending')
                    ->where('admin_cash_advance.menyetujui', $menyetujui);
            })
            ->orderByRaw("CASE 
    WHEN admin_cash_advance.status_approved = 'pending' AND admin_cash_advance.status_paid = 'pending' THEN 0
    WHEN admin_cash_advance.status_approved = 'rejected' AND admin_cash_advance.status_paid = 'rejected' THEN 1
    WHEN admin_cash_advance.pemohon = 'Yacob' THEN 2 
    ELSE 3 
END")
            ->orderBy('admin_cash_advance.tgl_diajukan', 'desc')
            // ->orderBy('admin_cash_advance.no_doku', 'desc')
            ->paginate(20);
        return view('halaman_direksi.cash_advance.index', [
            'title' => $title,
            'cash_advance' => $datacashadvance
        ]);
    }
    public function view_cash_advance($id)
    {
        $title = 'Lihat CA';
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
        return view('halaman_direksi.cash_advance.view_cash_advance', [
            'title' => $title,
            'cash_advance' => $cashadvance,
            'nominal' => $nominal_CA,
        ]);
    }
    public function view_CAR($id)
    {
        $title = 'Lihat CAR';
        $cashAdvanceReport = AdminCashAdvanceReport::find($id);
        $CAR_Detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_direksi.cash_advance.view_CAR', [
            'title' => $title,
            'CAR' => $cashAdvanceReport,
            'CAR_Detail' => $CAR_Detail,
            'nominal' => $nominal
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
            return redirect()->route('direksi.cash_advance')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui. ');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance')->with('gagal', $e->getMessage());
        }
    }

    public function tolak_cash_advance($id, Request $request)
    {
        try {
            $data = DB::table('admin_cash_advance')->where('id', $id)->first();
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'status_paid' => 'pending',
                'alasan' => $request->alasan
            ]);
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CA yang baru!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.beranda')->with('gagal', $e->getMessage());
        }
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
        $accounting = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 2)
            ->get();
        $kasir = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 3)
            ->get();
        $userLoggedIn = Auth::user()->nama;
        $menyetujuiOptions = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->where('nama', '!=', $userLoggedIn)
            ->orderBy('nama', 'asc')
            ->get();

        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_direksi.cash_advance.tambah_CA', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujuiOptions,
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
        return redirect()->route('direksi.cash_advance')->with('success', 'Data Cash Advance Berhasil Diajukan');
    }
    public function getNomor(Request $request)
    {
        $menyetujui = $request->input('menyetujui');

        $details = DB::table('menyetujui')->where('nama', $menyetujui)->get();

        if ($details->count() > 0) {

            foreach ($details as $detail) {
                $no_telp[] = $detail->no_telp;
            }

            $data = [
                'keterangan' => $no_telp,
            ];

            // Mengirim data ke tampilan sebagai respons JSON
            return response()->json($data);
        } else {
            // Jika data tidak ditemukan, mengirim respons JSON dengan data kosong
            return response()->json([]);
        }
    }
}
