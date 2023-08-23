<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\CashAdvanceExports;
use App\Http\Controllers\Controller;
use App\Models\Admin\CashAdvanceReport;
use Carbon\Carbon;
use DateTime;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CashAdvanceController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Cash Advance';
        $kasir = Auth::guard('kasir')->user()->nama;
        if ($request->has('search')) {
            $dataCA = DB::table('admin_cash_advance')
                ->where('admin_cash_advance.pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('admin_cash_advance.judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('b.no_doku', 'LIKE', '%' . $request->search . '%')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->orderBy('admin_cash_advance.no_doku', 'desc')
                ->whereIn('admin_cash_advance.status_approved', ['approved'])
                ->whereIn('admin_cash_advance.status_paid', ['pending'])
                ->paginate(100);
        } elseif ($request->has('bulan')) {
            $query =  DB::table('admin_cash_advance')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->orderBy('admin_cash_advance.no_doku', 'asc')
                ->whereIn('admin_cash_advance.status_approved', ['approved'])
                ->whereIn('admin_cash_advance.status_paid', ['pending']);

            // Memeriksa apakah parameter bulan dikirimkan dalam request POST
            if ($request->has('bulan')) {
                $bulan = $request->input('bulan'); // Ambil nilai bulan dari input form

                // Pisahkan nilai bulan dan tahun dari input bulan
                list($tahun, $bulan) = explode('-', $bulan);
                $query = DB::table('admin_cash_advance')
                    ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                    ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                    ->whereMonth('admin_cash_advance.tgl_diajukan', $bulan)
                    ->whereYear('admin_cash_advance.tgl_diajukan', $tahun)
                    ->orderBy('admin_cash_advance.no_doku', 'asc');
            }
            $dataCA = $query->paginate(100);
        } else {
            $dataCA = DB::table('admin_cash_advance')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->orderBy('admin_cash_advance.no_doku', 'desc')
                ->where('admin_cash_advance.pemohon', $kasir)
                ->orWhere('admin_cash_advance.kasir', $kasir)
                ->whereIn('admin_cash_advance.status_approved', ['approved'])
                ->whereIn('admin_cash_advance.status_paid', ['pending'])
                ->paginate(20);
        }

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
        return view('halaman_finance.cash_advance.view_cash_advance', [
            'title' => $title,
            'cash_advance' => $cashadvance,
            'nominal' => $nominal_CA,

        ]);
    }
    public function view_CAR($id)
    {
        $title = 'Lihat CAR';
        $cashAdvanceReport = CashAdvanceReport::find($id);
        $CAR_Detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_finance.cash_advance.view_CAR', [
            'title' => $title,
            'CAR' => $cashAdvanceReport,
            'CAR_Detail' => $CAR_Detail,
            'nominal' => $nominal
        ]);
    }
    public function print_cash_advance($id)
    {
        $title = 'Cetak Cash Advance';
        $cashadvance = DB::table('admin_cash_advance')->find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
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
            'no_referensi' => $request->no_ref,
            'tgl_bayar' => Carbon::now()
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.cash_advance')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
    public function tambah_CA()
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
            'menyetujui' => $request->nama_menyetujui,
            'no_telp' => $request->no_telp
        ]);
        return redirect()->route('kasir.cash_advance')->with('success', 'Data Cash Advance Berhasil Diajukan!');
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
