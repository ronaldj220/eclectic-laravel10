<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\Admin\CashAdvanceReport;
use App\Models\Admin\CashAdvanceReportDetail;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;


class CashAdvanceReportController extends Controller
{
    public function index()
    {
        $title = 'CAR';
        $menyetujui = Auth::user()->nama;
        $datacashadvancereport = DB::table('admin_cash_advance_report')
            ->where('pemohon', $menyetujui)
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('status_approved', 'pending')
                    ->where('status_paid', 'pending')
                    ->where('menyetujui', $menyetujui);
            })

            ->orderByRaw("CASE 
    WHEN status_approved = 'pending' AND status_paid = 'pending' THEN 0
    WHEN status_approved = 'rejected' AND status_paid = 'rejected' THEN 1
    WHEN pemohon = 'Yacob' THEN 2 
    ELSE 3 
END")
            ->orderBy('tgl_diajukan', 'desc')
            ->orderBy('no_doku', 'desc')
            ->paginate(20);
        return view('halaman_direksi.cash_advance_report.index', [
            'title' => $title,
            'cash_advance_report' => $datacashadvancereport
        ]);
    }
    public function view_cash_advance_report($id)
    {
        $title = 'Lihat Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal_CAR = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_direksi.cash_advance_report.view_cash_advance_report', [
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

        return view('halaman_direksi.cash_advance_report.view_CA', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA
        ]);
    }
    public function print_bukti_cash_advance_report($id)
    {
        $title = 'Cetak Cash Advance Report';
        $data_CAR = DB::table('admin_cash_advance_report')->find($id);
        $cash_advance_report_detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();

        return view('halaman_direksi.cash_advance_report.print_bukti_cash_advance_report', [
            'title' => $title,
            'cash_advance_report' => $data_CAR,
            'bukti_CAR' => $cash_advance_report_detail,
        ]);
    }
    public function setujui_cash_advance_report($id)
    {
        try {
            $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
            DB::table('admin_cash_advance_report')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
                'tgl_persetujuan' => Carbon::now()
            ]);
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_cash_advance_report(Request $request, $id)
    {
        try {
            $data = DB::table('admin_cash_advance_report')->where('id', $id)->first();
            DB::table('admin_cash_advance_report')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.cash_advance_report')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CAR yang berbeda');
        } catch (\Exception $e) {
            return redirect()->route('direksi.cash_advance_report')->with('gagal', $e->getMessage());
        }
    }
    public function paid_CAR(Request $request, $id)
    {
        $data = DB::table('admin_cash_advance_report')->find($id);
        DB::table('admin_cash_advance_report')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref,
            'tgl_bayar' => Carbon::now()
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('direksi.cash_advance_report')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
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
            $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
            } else {
                $no_dokumen = date('y') . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . sprintf("%05s", abs($no));
            }
        }
        // dd($no_dokumen);
        $accounting = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 2)
            ->get();
        $kasir = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 3)
            ->get();
        $userLoggedIn = Auth::user()->nama;
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->where('nama', '!=', $userLoggedIn)
            ->orderBy('nama', 'asc')
            ->get();
        $direksi = Auth::user()->nama;
        $cash_advance = DB::select(
            '
        SELECT ca.no_doku
        FROM admin_cash_advance ca
        LEFT JOIN admin_cash_advance_report car ON ca.no_doku = car.tipe_ca
        WHERE car.no_doku IS NULL AND ca.pemohon = ? 
        ORDER BY ca.tgl_diajukan DESC',
            [$direksi]
        );

        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_direksi.cash_advance_report.tambah_CAR', [
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
                'judul_doku' => $result[0]->judul_doku,
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
        return redirect()->route('direksi.cash_advance_report')->with('success', 'Data CAR Berhasil Diajukan');
    }
}
