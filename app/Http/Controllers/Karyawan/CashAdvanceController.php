<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashAdvanceController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Cash Advance';
        $authId = Auth::guard('karyawan')->user()->nama;
        if ($request->has('search')) {
            $dataCashAdvance = DB::table('admin_cash_advance')
                ->where('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orderBy('no_doku', 'desc')
                ->orderBy('tgl_diajukan', 'desc')
                ->paginate(20);
        }
        $dataCashAdvance = DB::table('admin_cash_advance')
            ->where('pemohon', $authId)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['rejected', 'pending', 'approved'])
            ->whereIn('status_paid', ['pending', 'rejected', 'paid'])
            ->paginate(10);

        return view('halaman_karyawan.cash_advance.index', [
            'title' => $title,
            'CashAdvance' => $dataCashAdvance,
        ]);
    }
    public function tambah_cash_advance()
    {
        $title = 'Tambah Cash Advance';
        $AWAL = 'CA';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_cash_advance')
            ->whereRaw('MONTH(tgl_diajukan) = MONTH(CURRENT_DATE())')
            ->whereRaw('YEAR(tgl_diajukan) = YEAR(CURRENT_DATE())')
            ->count();
        $no = 1;
        $no_dokumen = null;
        $currentMonth = date('n');
        // dd($noUrutAkhir);
        if ($currentMonth) {
            $no_dokumen = date('y') . '/' . $bulanRomawi[$currentMonth] . '/' . $AWAL . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        } else {
            $no_dokumen = date('y') . '/' . $bulanRomawi[$currentMonth] . '/' . $AWAL . '/' . sprintf("%05s", abs($no + 1));
        }

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
            'menyetujui' => $request->nama_menyetujui,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->route('karyawan.cash_advance')->with('success', 'Data Cash Advance Berhasil Diajukan!');
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
