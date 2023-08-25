<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\CashAdvanceReportExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\CashAdvanceReport;
use App\Models\Admin\CashAdvanceReportDetail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManagerStatic as Image;

class CashAdvanceReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Cash Advance Report';
        $kasir = Auth::guard('kasir')->user()->nama;
        if ($request->has('search')) {
            $dataCAR = DB::table('admin_cash_advance_report')
                ->where('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('tipe_ca', 'LIKE', '%' . $request->search . '%')
                ->orderBy('no_doku', 'desc')
                ->paginate(100);
        } elseif ($request->has('bulan')) {
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

            $dataCAR = $query->paginate(100);
        } else {
            $dataCAR = DB::table('admin_cash_advance_report')
                ->orderBy('no_doku', 'desc')
                ->where('pemohon', $kasir)
                ->orWhere('kasir', $kasir)
                ->whereIn('status_approved', ['rejected', 'approved'])
                ->whereIn('status_paid', ['rejected', 'pending'])
                ->paginate(20);
        }

        return view('halaman_finance.cash_advance_report.index', [
            'title' => $title,
            'cash_advance_report' => $dataCAR
        ]);
    }
    public function view_cash_advance_report($id)
    {
        $title = 'Lihat Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_finance.cash_advance_report.view_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'data_CAR' => $cash_advance_report_detail,
            'nominal' => $nominal_CAR
        ]);
    }
    public function view_CA($id)
    {
        $title = 'Lihat CA';
        $cash_advance = CashAdvanceReport::find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        return view('halaman_finance.cash_advance_report.view_CA', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA
        ]);
    }
    public function print_cash_advance_report($id)
    {
        $title = 'Cetak Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_finance.cash_advance_report.print_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'data_CAR' => $cash_advance_report_detail,
            'nominal' => $nominal_CAR
        ]);
    }
    public function print_bukti_cash_advance_report($id)
    {
        $title = 'Cetak Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();

        return view('halaman_finance.cash_advance_report.print_bukti_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'bukti_CAR' => $cash_advance_report_detail,
        ]);
    }
    public function excel_cash_advance_report($id)
    {
        return Excel::download(new CashAdvanceReportExport($id), 'CAR_kasir_' . $id . '.xlsx');
    }
    public function bayar_cash_advance_report($id)
    {
        $title = 'Bayar Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->where('id', $id)->first();
        $data_CAR_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_finance.cash_advance_report.bayar_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'CAR_detail' => $data_CAR_detail,
            'nominal' => $nominal_CAR
        ]);
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
        return redirect()->route('kasir.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
    // Fungsi untuk Bayar CAR dengan nilai 0
    public function done_CAR($id)
    {
        $data = DB::table('admin_cash_advance_report')->find($id);
        DB::table('admin_cash_advance_report')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' telah lunas!');
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


        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $kasir_guard = Auth::guard('kasir')->user()->nama;
        $cash_advance = DB::select('SELECT * FROM admin_cash_advance WHERE pemohon = ?', [$kasir_guard]);

        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_finance.cash_advance_report.tambah_CAR', [
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
        $cashAdvance->nominal_ca = $request->nominal_ca;
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
        return redirect()->route('kasir.cash_advance_report')->with('success', 'Data Cash Advance Report Berhasil Diajukan!');
    }
}
