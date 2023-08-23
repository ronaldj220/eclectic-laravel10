<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\CashAdvanceReport as AdminCashAdvanceReport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Cash_Advance;
use App\Models\Admin\CashAdvanceReport;
use App\Models\Admin\CashAdvanceReportDetail;
use Carbon\Carbon;
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
                ->where('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('tipe_ca', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tgl_diajukan', 'desc')
                ->orderBy('no_doku', 'desc')
                ->paginate(1000);
        } else {
            $dataCashAdvanceReport = DB::table('admin_cash_advance_report')
                ->orderBy('no_doku', 'desc')
                ->paginate(20);
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
            ->orderBy('no_doku', 'asc')
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

        $dataCashAdvanceReport = $query->paginate(100);

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
        $noUrutAkhir = DB::table('admin_cash_advance_report')
            ->whereRaw('MONTH(tgl_diajukan) = MONTH(CURRENT_DATE())')
            ->whereRaw('YEAR(tgl_diajukan) = YEAR(CURRENT_DATE())')
            ->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        $currentMonth = date('n');
        if (date('j') == 1) {
            $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($noUrutAkhir));
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
            } else {
                $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($no));
            }
        }
        // dd($no_dokumen);
        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $cash_advance = DB::select('SELECT * FROM admin_cash_advance ORDER BY no_doku ASC');

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::table('karyawan')
            ->select('nama')
            ->union(DB::table('menyetujui')->select('nama'))
            ->union(DB::table('kasir')->select('nama'))
            ->orderBy('nama')
            ->get();
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
                'no_telp' => $result[0]->no_telp
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
        $cashAdvance->no_telp = $request->no_telp;
        $cashAdvance->save();

        foreach ($request->deskripsi as $deskripsi => $value) {
            $CA_detail =  new CashAdvanceReportDetail();
            $CA_detail->deskripsi = $value;

            if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                $file = $request->file('foto')[$deskripsi];

                // Menyimpan gambar asli tanpa kompresi
                $filePath = 'bukti_CAR_admin/' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('bukti_CAR_admin'), $filePath);
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
    public function view_CA($id)
    {
        $title = 'Lihat CA';
        $cash_advance = CashAdvanceReport::find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');

        return view('halaman_admin.admin.cash_advance_report.view_CA', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA
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
            return redirect()->route('admin.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.beranda')->with('gagal', $e->getMessage());
        }
    }
    public function reject_cash_advance_report($id, Request $request)
    {
        try {
            $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
            try {
                DB::table('admin_cash_advance_report')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
                $no_doku = $data->no_doku;
                $alasan = $request->alasan;
                return redirect()->route('admin.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CAR yang baru!');
            } catch (\Exception $e) {
                return redirect()->route('admin.cash_advance_report')->with('gagal', $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
    public function setujui_CAR($id)
    {
        try {
            DB::table('admin_cash_advance_report')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_cash_advance_report')->find($id);
            $no_doku = $data->no_doku;
            return redirect()->route('admin.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.beranda')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_CAR($id, Request $request)
    {
        try {
            $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
            try {
                DB::table('admin_cash_advance_report')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
                $no_doku = $data->no_doku;
                $alasan = $request->alasan;
                return redirect()->route('admin.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CAR yang baru!');
            } catch (\Exception $e) {
                return redirect()->route('admin.cash_advance_report')->with('gagal', $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
    public function hapus_CAR($id)
    {
        $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
        $no_doku = $data->no_doku;
        try {
            DB::table('admin_cash_advance_report')->where('id', $id)->delete();
            DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->delete();

            return redirect()->route('admin.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Tangani jika terjadi kesalahan
            return redirect()->route('admin.cash_advance')->with('error', 'Gagal menghapus CA terkait.');
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
        return redirect()->route('admin.cash_advance_report')->with('success', 'Data Cash Advance Report Berhasil Diperbarui!');
    }
    public function paid_CAR($id, Request $request)
    {
        $data = DB::table('admin_cash_advance_report')->find($id);
        DB::table('admin_cash_advance_report')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref,
            'tgl_bayar' => Carbon::now()
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('admin.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
    public function kirim_WA($id)
    {
        $cash_advance = DB::table('admin_cash_advance_report')->find($id);

        $nomorTelepon = [
            $cash_advance->no_telp,
        ];

        // Membangun pesan yang diinginkan
        $pesan = "[Ini Adalah Pesan Dari Sistem]\nAda Permohonan CAR No. " . $cash_advance->no_doku . " Dari " . $cash_advance->pemohon . " Menunggu Approval. \nKlik Disini untuk Melihat \nhttps://office.eclectic.co.id/";

        $urlWhatsApp = 'https://api.whatsapp.com/send';

        $berhasilDikirim = [];

        foreach ($nomorTelepon as $nomor) {
            try {
                $url = $urlWhatsApp . '?phone=' . $nomor . '&text=' . urlencode($pesan);
                $berhasilDikirim[] = $nomor;
            } catch (\Exception $e) {
                // Tangani kesalahan yang terjadi
                dd($e->getMessage());
            }
        }

        // Lakukan penanganan sesuai kebutuhan dengan menggunakan array berhasilDikirim
        if (!empty($berhasilDikirim)) {
            // Redirect ke halaman WhatsApp
            $redirectUrl = $urlWhatsApp . '?phone=' . implode(',', $berhasilDikirim) . '&text=' . urlencode($pesan);
            header("Location: " . $redirectUrl);
            exit();
            // dd($redirectUrl);
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pesan WhatsApp.');
        }
    }
}
