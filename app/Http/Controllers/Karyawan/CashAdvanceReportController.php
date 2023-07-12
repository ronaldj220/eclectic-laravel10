<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Admin\CashAdvanceReport;
use App\Models\Admin\CashAdvanceReportDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;


class CashAdvanceReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Cash Advance Report';
        $karyawan = Auth::guard('karyawan')->user()->nama;
        if ($request->has('search')) {
            $dataCashAdvanceReport = DB::table('admin_cash_advance_report')
                ->where('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orderBy('no_doku', 'desc')
                ->orderBy('tgl_diajukan', 'desc')
                ->paginate(20);
        }
        $dataCashAdvanceReport = DB::table('admin_cash_advance_report')
            ->orderBy('no_doku', 'desc')
            ->where('pemohon', $karyawan)
            ->paginate(10);

        return view('halaman_karyawan.cash_advance_report.index', [
            'title' => $title,
            'CAR' => $dataCashAdvanceReport
        ]);
    }
    public function tambah_CAR()
    {
        $title = 'Cash Advance Report';
        $AWAL = 'CAR';
        $bulanRomawi = array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $noUrutAkhir = DB::table('admin_cash_advance_report')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        $currentMonth = date('n');
        if (date('j') == 1) {
            $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($no));
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
            } else {
                $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($no));
            }
        }


        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $karyawan = Auth::guard('karyawan')->user()->nama;
        $cash_advance = DB::select('SELECT * FROM admin_cash_advance WHERE pemohon = ?', [$karyawan]);

        $currency = DB::select('SELECT * FROM kurs');
        return view('halaman_karyawan.cash_advance_report.tambah_CAR', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'cash_advance' => $cash_advance,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency
        ]);
    }
    public function getNominal(Request $request)
    {
        $tipe_ca_id = $request->input('tipe_ca_id');
        $result = DB::select('SELECT nominal, pemohon, menyetujui FROM admin_cash_advance WHERE no_doku = ?', [$tipe_ca_id]);

        return response()->json([
            'nominal_ca' => $result[0]->nominal,
            'pemohon' => $result[0]->pemohon,
            'menyetujui' => $result[0]->menyetujui
        ]);
    }
    public function simpan_CAR(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $cashAdvance = new CashAdvanceReport();
        $cashAdvance->no_doku = $request->no_doku;
        $cashAdvance->tgl_diajukan = $tgl_diajukan;
        $cashAdvance->tipe_ca = $request->tipe_ca_id;
        $cashAdvance->nominal_ca = $request->nominal_ca;
        $cashAdvance->judul_doku = $request->judul_doku;
        $cashAdvance->pemohon = $request->pemohon;
        $cashAdvance->accounting = $request->accounting;
        $cashAdvance->kasir = $request->kasir;
        $cashAdvance->menyetujui = $request->nama_menyetujui;
        $cashAdvance->save();

        foreach ($request->deskripsi as $deskripsi => $value) {
            $CA_detail =  new CashAdvanceReportDetail();
            $CA_detail->deskripsi = $value;

            if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                $file = $request->file('foto')[$deskripsi];
                // Menggunakan Intervention Image untuk memuat gambar
                $image = Image::make($file);

                // Mengatur ukuran maksimum yang diinginkan (misalnya 800 piksel lebar dan 600 piksel tinggi)
                $image->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio(); // Mempertahankan aspek rasio gambar
                    $constraint->upsize(); // Memastikan gambar tidak diperbesar jika lebih kecil dari ukuran yang ditentukan
                });

                // Menyimpan gambar yang telah dikompresi
                $filePath = public_path('bukti_CAR_karyawan/') . time() . '.' . $file->getClientOriginalExtension();
                $image->save($filePath);
                $fileName = basename($filePath);
                $CA_detail->bukti_ca = $fileName;
            }

            $CA_detail->no_bukti = $request->nobu[$deskripsi];
            $CA_detail->curr = $request->kurs[$deskripsi];
            $CA_detail->nominal = $request->nom[$deskripsi];
            $CA_detail->tanggal_1 = $request->tgl1[$deskripsi];
            $CA_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
            $CA_detail->keperluan = $request->keperluan[$deskripsi];
            $CA_detail->fk_ca = $cashAdvance->id;
            $CA_detail->save();
        }
        return redirect()->route('karyawan.cash_advance_report')->with('success', 'Data Cash Advance Report Berhasil Diajukan!');
    }

    public function view_CAR($id)
    {
        $title = 'Lihat CAR';
        $cashAdvanceReport = DB::table('admin_cash_advance_report')->find($id);
        $CAR_Detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_karyawan.cash_advance_report.view_CAR', [
            'title' => $title,
            'cash_advance_report' => $cashAdvanceReport,
            'car_detail' => $CAR_Detail,
            'nominal' => $nominal
        ]);
    }
}
