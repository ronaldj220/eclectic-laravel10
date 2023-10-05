<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\CashAdvanceExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Cash_Advance;
use App\Models\Admin\CashAdvanceReport;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class Cash_AdvanceController extends Controller
{
    public function index(Request $request)
    {
        $title = 'CA';
        if ($request->has('search')) {
            $dataCashAdvance = DB::table('admin_cash_advance')
                ->where('admin_cash_advance.pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('admin_cash_advance.judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('b.no_doku', 'LIKE', '%' . $request->search . '%')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->orderBy('admin_cash_advance.no_doku', 'desc')
                ->paginate(100);
        } elseif ($request->has('bulan') && $request->has('search')) {
            $bulan = $request->bulan;
            $search = $request->search;

            $dataCashAdvance = DB::table('admin_cash_advance')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->whereMonth('admin_cash_advance.tgl_diajukan', date('m', strtotime($bulan)))
                ->whereYear('admin_cash_advance.tgl_diajukan', date('Y', strtotime($bulan)))
                ->where(function ($query) use ($search) {
                    $query->where('admin_cash_advance.no_doku', 'like', '%' . $search . '%')
                        ->orWhere('admin_cash_advance.judul_doku', 'like', '%' . $search . '%')
                        ->orWhere('admin_cash_advance.pemohon', 'like', '%' . $search . '%');
                })
                ->orderBy('admin_cash_advance.no_doku', 'asc')
                ->paginate(100);
        } elseif ($request->has('bulan')) {
            $bulan = $request->bulan;

            $dataCashAdvance = DB::table('admin_cash_advance')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->whereMonth('admin_cash_advance.tgl_diajukan', date('m', strtotime($bulan)))
                ->whereYear('admin_cash_advance.tgl_diajukan', date('Y', strtotime($bulan)))
                ->orderBy('admin_cash_advance.no_doku', 'asc')
                ->paginate(100);
        } else {
            $dataCashAdvance = DB::table('admin_cash_advance')
                ->select('admin_cash_advance.id', 'admin_cash_advance.no_doku', 'admin_cash_advance.tgl_diajukan', 'admin_cash_advance.judul_doku', 'admin_cash_advance.pemohon', 'b.id as id_car', 'b.no_doku as tipe_car', 'admin_cash_advance.status_approved', 'admin_cash_advance.status_paid')
                ->leftJoin('admin_cash_advance_report as b', 'admin_cash_advance.no_doku', '=', 'b.tipe_ca')
                ->orderBy('admin_cash_advance.tgl_diajukan', 'desc')
                ->paginate(20);
        }
        return view('halaman_admin.admin.cash_advance.index', [
            'title' => $title,
            'CashAdvance' => $dataCashAdvance,
        ]);
    }

    public function tambah_CA()
    {
        $title = 'Tambah CA';
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
        // dd($currentMonth);

        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 3)
            ->get();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = User::all();
        return view('halaman_admin.admin.cash_advance.tambah_cash_advance', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan
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
        return redirect()->route('admin.cash_advance')->with('success', 'Data Cash Advance Berhasil Diajukan!');
    }
    public function view_CA($id)
    {
        $title = 'Lihat Cash Advance';
        $cash_advance = Cash_Advance::find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');
        return view('halaman_admin.admin.cash_advance.view_cash_advance', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA
        ]);
    }
    public function view_CAR($id)
    {
        $title = 'Lihat CAR';
        $cashAdvanceReport = CashAdvanceReport::find($id);
        $CAR_Detail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->get();
        $nominal = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $id)->sum('nominal');

        return view('halaman_admin.admin.cash_advance.view_CAR', [
            'title' => $title,
            'CAR' => $cashAdvanceReport,
            'CAR_Detail' => $CAR_Detail,
            'nominal' => $nominal
        ]);
    }
    public function setujui_CA($id)
    {
        $data = DB::table('admin_cash_advance')->find($id);
        try {
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $no_doku = $data->no_doku;
            return redirect()->route('admin.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' Berhasil Diajukan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance')->with('gagal', $e->getMessage());
        }
    }
    public function reject_CA($id)
    {
        try {
            $data = DB::table('admin_cash_advance')->where('id', $id)->first();
            try {
                DB::table('admin_cash_advance')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending'
                ]);
                $no_doku = $data->no_doku;
                return redirect()->route('admin.cash_advance')->with('error', 'Data dengan no dokumen' . $no_doku . ' tidak disetujui! Mohon Ajukan CA yang berbeda!');
            } catch (\Exception $e) {
                return redirect()->route('admin.cash_advance')->with('gagal', $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance')->with('gagal', $e->getMessage());
        }
    }
    public function print_CA($id)
    {
        $title = 'Cetak Cash Advance';
        $cash_advance = Cash_Advance::find($id);
        $nominal_CA = DB::table('admin_cash_advance')->where('id', $id)->sum('nominal');

        return view('halaman_admin.admin.cash_advance.print_cash_advance', [
            'title' => $title,
            'cash_advance' => $cash_advance,
            'nominal' => $nominal_CA,

        ]);
    }
    public function excel_CA($id)
    {
        return FacadesExcel::download(new CashAdvanceExport($id), 'cash_advance_' . $id . '.xlsx');
    }
    public function edit_CA($id)
    {
        $CA = DB::table('admin_cash_advance')->where('id', $id)->first();
        $title = 'Edit Reimbursement';
        $menyetujui = DB::select('SELECT * from menyetujui');
        $currency = DB::select('SELECT * FROM kurs');

        return view('halaman_admin.admin.cash_advance.edit_CA', [
            'title' => $title,
            'CA' => $CA,
            'kurs' => $currency,
            'menyetujui' => $menyetujui
        ]);
    }
    public function update_CA($id, Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');
        $tgl_diajukan2 = isset($request->tgl_diajukan2) ? $request->tgl_diajukan2 : null;

        DB::table('admin_cash_advance')->where('id', $id)
            ->update([
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
        return redirect()->route('admin.cash_advance')->with('success', 'Data Cash Advance Berhasil Diperbarui!');
    }
    // Untuk Menyetujui Aris
    public function approved_CA($id)
    {
        try {
            $data = DB::table('admin_cash_advance')->where('id', $id)->first();
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
            ]);
            $no_doku = $data->no_doku;
            return redirect()->route('admin.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_CA($id, Request $request)
    {
        try {
            $data = DB::table('admin_cash_advance')->where('id', $id)->first();
            DB::table('admin_cash_advance')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('admin.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan CA yang baru!');
        } catch (\Exception $e) {
            return redirect()->route('admin.cash_advance')->with('gagal', $e->getMessage());
        }
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
    public function kirim_WA($id)
    {
        $cash_advance = DB::table('admin_cash_advance')->find($id);

        $nomorTelepon = [
            $cash_advance->no_telp,
        ];

        // Membangun pesan yang diinginkan
        $pesan = "[Ini Adalah Pesan Dari Sistem]\nAda Permohonan CA No. " . $cash_advance->no_doku . " Dari " . $cash_advance->pemohon . " Menunggu Approval. \nKlik Disini untuk Melihat \nhttps://office.eclectic.co.id/";

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
    public function hapus_CA($id)
    {
        $data = DB::table('admin_cash_advance')->where('id', $id)->first();
        $no_doku = $data->no_doku;
        try {
            DB::table('admin_cash_advance')->where('id', $id)->delete();

            return redirect()->route('admin.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Tangani jika terjadi kesalahan
            return redirect()->route('admin.cash_advance')->with('error', 'Gagal menghapus CA terkait.');
        }
    }
}
