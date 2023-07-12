<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\CashAdvanceReport as AdminCashAdvanceReport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Cash_Advance;
use App\Models\Admin\CashAdvanceReport;
use App\Models\Admin\CashAdvanceReportDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManagerStatic as Image;


class CashAdvanceReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Cash Advance Report';
        if ($request->has('search')) {
            $dataCashAdvanceReport = DB::table('admin_cash_advance_report')
                ->where('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tgl_diajukan', 'desc')
                ->orderBy('no_doku', 'desc')
                ->paginate(20);
        } else {
            $dataCashAdvanceReport = DB::table('admin_cash_advance_report')
                ->orderBy('no_doku', 'desc')
                ->paginate(10);
        }

        return view('halaman_admin.admin.cash_advance_report.index', [
            'title' => $title,
            'cashAdvance' => $dataCashAdvanceReport
        ]);
    }
    public function search_by_date(Request $request)
    {
        $title = 'Cash Advance Report';
        $query = DB::table('admin_cash_advance_report')
            ->orderBy('no_doku', 'desc')
            ->orderByRaw("
            CASE
                WHEN status_approved = 'approved' THEN 1
                WHEN status_approved = 'pending' THEN 2
                WHEN status_approved = 'rejected' THEN 3
                ELSE 4
            END
        ");

        // Memeriksa apakah parameter bulan dikirimkan dalam request POST
        if ($request->has('bulan')) {
            $bulan = $request->bulan;
            $query->whereMonth('tgl_diajukan', date('m', strtotime($bulan)))
                ->whereYear('tgl_diajukan', date('Y', strtotime($bulan)));
        }

        $dataCashAdvanceReport = $query->paginate(20);

        return view('halaman_admin.admin.cash_advance_report.index', [
            'title' => $title,
            'cashAdvance' => $dataCashAdvanceReport
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

        $cash_advance = DB::select('SELECT * FROM admin_cash_advance');

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::select('SELECT * FROM karyawan');
        return view('halaman_admin.admin.cash_advance_report.tambah_cash_advance_report', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'cash_advance' => $cash_advance,
            'karyawan' => $karyawan
        ]);
    }
    public function getNominal(Request $request)
    {
        $tipe_ca_id = $request->input('tipe_ca_id');

        $result = DB::select('SELECT * FROM admin_cash_advance WHERE no_doku = ?', [$tipe_ca_id]);
        $nominal = number_format($result[0]->nominal, 2, '.', '');

        return response()->json(
            [
                'nominal_ca' => $nominal,
                'pemohon' => $result[0]->pemohon,
                'nama_menyetujui' => $result[0]->menyetujui,
            ]
        );
    }
    public function simpan_CAR(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $cashAdvance = new CashAdvanceReport();
        $cashAdvance->no_doku = $request->no_doku;
        $cashAdvance->tgl_diajukan = $tgl_diajukan;
        $cashAdvance->tipe_ca = $request->tipe_ca_id;
        // Hapus tanda koma (',') dari nominal_ca sebelum menyimpannya
        $nominalCa = str_replace(',', '', $request->nominal_ca);
        $cashAdvance->nominal_ca = $nominalCa;
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
                $filePath = public_path('bukti_CAR_admin/') . time() . '.' . $file->getClientOriginalExtension();
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
        return redirect()->route('admin.cash_advance_report')->with('success', 'Data Cash Advance Report Berhasil Diajukan!');
    }
    public function excel_cash_advance_report($id)
    {
        return Excel::download(new AdminCashAdvanceReport($id), 'cash_advance_report_' . $id . '.xlsx');
    }
    public function view_cash_advance_report($id)
    {
        $title = 'Lihat Cash Advance Report';
        $cashAdvanceReport = CashAdvanceReport::find($id);
        $CAR_Detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');
        return view('halaman_admin.admin.cash_advance_report.view_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $cashAdvanceReport,
            'car_detail' => $CAR_Detail,
            'nominal' => $nominal
        ]);
    }
    public function setujui_cash_advance_report($id)
    {
        try {
            DB::table('admin_cash_advance_report')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_cash_advance_report')->find($id);
            $no_doku = $data->no_doku;
            return redirect()->route('admin.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil Diajukan! Mohon Menunggu Kepastian ya... Semoga diterima!');
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
    public function print_cash_advance_report($id)
    {
        $title = 'Cetak Cash Advance Report';
        $cash_advance_report = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_admin.admin.cash_advance_report.print_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $cash_advance_report,
            'CAR_Detail' => $cash_advance_report_detail,
            'nominal' => $nominal_CAR
        ]);
    }
    public function print_bukti_cash_advance_report($id)
    {
        $title = 'Cetak Bukti Cash Advance Report';
        $bukti_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        return view('halaman_admin.admin.cash_advance_report.print_bukti_cash_advance_report', [
            'title' => $title,
            'bukti_CAR' => $bukti_CAR
        ]);
    }
    public function edit_CAR($id)
    {
        $title = 'Edit Cash Advance Report';
        $CAR = DB::table('admin_cash_advance_report')->where('id', $id)->first();
        $menyetujui = DB::select('SELECT * from menyetujui');
        $currency = DB::select('SELECT * FROM kurs');
        $cash_advance = DB::select('SELECT * FROM admin_cash_advance');


        return view('halaman_admin.admin.cash_advance_report.edit_CAR', [
            'title' => $title,
            'CAR' => $CAR,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'cash_advance' => $cash_advance
        ]);
    }
    public function update_CAR(Request $request, $id)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        DB::table('admin_cash_advance_report')
            ->where('id', $id)
            ->update([
                'no_doku' => $request->no_doku,
                'tgl_diajukan' => $tgl_diajukan,
                'judul_doku' => $request->judul_doku,
                'tipe_ca' => $request->tipe_ca_id,
                'nominal_ca' => $request->nominal_ca,
                'pemohon' => $request->pemohon,
                'accounting' => $request->accounting,
                'kasir' => $request->kasir,
                'menyetujui' => $request->nama_menyetujui
            ]);

        foreach ($request->deskripsi as $deskripsi => $value) {
            $CAR_detail = [
                'deskripsi' => $value,
                'no_bukti' => $request->nobu[$deskripsi],
                'curr' => $request->kurs[$deskripsi],
                'nominal' => $request->nom[$deskripsi],
                'tanggal_1' => $request->tgl1[$deskripsi],
                'tanggal_2' => isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null,
                'keperluan' => $request->keperluan[$deskripsi],
                'fk_ca' => $id
            ];

            if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                $files = $request->file('foto');

                $file = $files[$deskripsi];
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . $deskripsi . '.' . $fileExtension;
                $filePath = public_path('bukti_ca/') . $fileName;

                $file->move(public_path('bukti_ca/'), $filePath);

                $CAR_Detail['bukti_ca'] = $fileName;
            }
            DB::table('admin_cash_advance_report_detail')
                ->where('fk_ca', $id)
                ->update($CAR_detail);
        }
    }
    public function paid_CAR($id, Request $request)
    {
        $data = DB::table('admin_cash_advance')->find($id);
        DB::table('admin_cash_advance')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('admin.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
}
