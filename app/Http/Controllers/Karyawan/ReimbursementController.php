<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rb_Detail;
use App\Models\Admin\Reimbursement as AdminReimbursement;
use App\Models\Admin\Support_Lembur_Detail;
use App\Models\Admin\Support_Ticket_Detail;
use App\Models\Admin\Timesheet_Project_Detail;
use App\Models\Karyawan\Reimbursement;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ReimbursementController extends Controller
{
    public function index()
    {
        $title = 'Reimbursement';
        $authId = Auth::guard('karyawan')->user()->nama;
        $dataReimbursement = DB::table('admin_reimbursement')
            ->where('pemohon', $authId)
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected')
            ->paginate(10);

        return view('halaman_karyawan.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement,
        ]);
    }
    public function search_by_date(Request $request)
    {
        $title = 'Reimbursement';
        $authId = Auth::guard('karyawan')->user()->nama;
        $query = DB::table('admin_reimbursement')
            ->where('pemohon', $authId)
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected');

        // Memeriksa apakah parameter bulan dikirimkan dalam request POST
        if ($request->has('bulan')) {
            $bulan = $request->bulan;
            $query->whereMonth('tgl_diajukan', date('m', strtotime($bulan)))
                ->whereYear('tgl_diajukan', date('Y', strtotime($bulan)));
        }
        $dataReimbursement = $query->paginate(10);

        return view('halaman_karyawan.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement
        ]);
    }
    public function search(Request $request)
    {
        $title = 'Reimbursement';
        $authId = Auth::guard('karyawan')->user()->nama;
        $query = DB::table('admin_reimbursement')
            ->where('pemohon', $authId)
            ->where('status_approved', 'rejected')
            ->where('status_paid', 'rejected');

        // Memeriksa apakah parameter bulan dikirimkan dalam request POST
        if ($request->has('cari')) {
            $cari = $request->cari;
            $query->where('judul_doku', 'LIKE', '%' . $cari . '%');
        } else {
            $query->paginate(10);
        }

        $dataReimbursement = $query->paginate(10);

        return view('halaman_karyawan.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement
        ]);
    }
    public function tambah_reimbursement()
    {
        $title = 'Tambah Reimbursement';
        $AWAL = 'RB';

        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_reimbursement')->max('id');
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if ($noUrutAkhir) {
            $no_dokumen = sprintf("%05s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('y');
        } else {
            $no_dokumen = sprintf("%05s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('y');
        }
        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::select('SELECT * FROM karyawan');
        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');
        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');

        $userRole = Auth::guard('karyawan')->user()->jabatan;
        $userRoleJSON = json_encode($userRole);

        return view('halaman_karyawan.reimbursement.tambah_reimbursement', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'nominal_awal' => $nominal_awal,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases,
            'userRoleJSON' => $userRoleJSON
        ]);
    }
    public function simpan_reimbursement(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $reimbursement = new AdminReimbursement();
        $reimbursement->no_doku = $request->no_doku;
        $reimbursement->tgl_diajukan = $tgl_diajukan;
        $reimbursement->judul_doku = $request->judul_doku;
        $reimbursement->pemohon = $request->pemohon;
        $reimbursement->accounting = $request->accounting;
        $reimbursement->kasir = $request->kasir;
        $reimbursement->menyetujui = $request->nama_menyetujui;
        if ($request->project === 'RB (Reimbursement)') {
            $reimbursement->halaman = 'RB';
        } elseif ($request->project === 'TS (Timesheet Support)') {
            $reimbursement->halaman = 'TS';
            if ($request->hasFile('bukti') && $request->file('bukti')->isValid()) {
                $files = $request->file('bukti');

                $fileExtension = $request->file('bukti')->getClientOriginalExtension();
                // Proses Simpan File ke dalam Nama ST
                $file = $request->file('bukti');
                $fileName = time() . '.' . $fileExtension;
                $file->move(public_path('bukti_TS_karyawan/'), $fileName);
                $reimbursement->bukti_timesheet_project = $fileName;
            }
        } elseif ($request->project === 'ST (Support Ticket)') {
            $reimbursement->halaman = 'ST';
            if ($request->hasFile('bukti') && $request->file('bukti')->isValid()) {
                $files = $request->file('bukti');

                $fileExtension = $request->file('bukti')->getClientOriginalExtension();
                // Proses Simpan File ke dalam Nama ST
                $file = $request->file('bukti');
                $fileName = time() . '.' . $fileExtension;
                $file->move(public_path('bukti_ST_karyawan/'), $fileName);
                $reimbursement->bukti_support_ticket = $fileName;
            }
        } elseif ($request->project === 'SL (Support Lembur)') {
            $reimbursement->halaman = 'SL';
            if ($request->hasFile('bukti') && $request->file('bukti')->isValid()) {
                $files = $request->file('bukti');

                $fileExtension = $request->file('bukti')->getClientOriginalExtension();
                // Proses Simpan File ke dalam Nama ST
                $file = $request->file('bukti');
                $fileName = time() . '.' . $fileExtension;
                $file->move(public_path('bukti_SL_karyawan/'), $fileName);
                $reimbursement->bukti_support_lembur = $fileName;
            }
        } else {
            $reimbursement->halaman = 'RB';
        }
        $reimbursement->save();

        if ($request->project === 'RB (Reimbursement)') {

            foreach ($request->deskripsi as $deskripsi => $value) {
                $rb_detail = new Rb_Detail();
                $rb_detail->deskripsi = $value;

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
                    $filePath = public_path('bukti_reim/') . time() . '.' . $file->getClientOriginalExtension();
                    $image->save($filePath);
                    $fileName = basename($filePath);

                    $rb_detail->bukti_reim = $fileName;
                }

                $rb_detail->no_bukti = $request->nobu[$deskripsi];
                $rb_detail->curr = $request->kurs_rb[$deskripsi];
                $rb_detail->nominal = $request->nom_rb[$deskripsi];
                $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                $rb_detail->keperluan = $request->keperluan[$deskripsi];
                $rb_detail->fk_rb = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'TS (Timesheet Support)') {
            foreach ($request->karyawan_ts as $index => $nama_karyawan) {
                $rb_detail = new Timesheet_Project_Detail();
                $rb_detail->nama_karyawan = $nama_karyawan;
                $rb_detail->curr = $request->kurs_ts[$index];
                $rb_detail->nominal_awal = $request->nom_ts[$index];
                $rb_detail->hari_awal = $request->hari_ts1[$index];
                $rb_detail->hari = $request->hari_ts2[$index];
                $rb_detail->fk_timesheet_project = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'ST (Support Ticket)') {
            foreach ($request->karyawan_st as $deskripsi => $nama_karyawan) {
                $rb_detail = new Support_Ticket_Detail();
                $rb_detail->nama_karyawan = $nama_karyawan;
                $rb_detail->aliases = $request->project_st[$deskripsi];
                $rb_detail->curr = $request->kurs_st[$deskripsi];
                $rb_detail->nominal_awal = $request->nom_st[$deskripsi];
                $rb_detail->jam = $request->jam_st[$deskripsi];
                $rb_detail->fk_support_ticket = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'SL (Support Lembur)') {
            foreach ($request->karyawan_st as $deskripsi => $nama_karyawan) {
                $rb_detail = new Support_Lembur_Detail();
                $rb_detail->nama_karyawan = $nama_karyawan;
                $rb_detail->aliases = $request->project_st[$deskripsi];
                $rb_detail->curr = $request->kurs_st[$deskripsi];
                $rb_detail->nominal_awal = $request->nom_st[$deskripsi];
                $rb_detail->jam = $request->jam_st[$deskripsi];
                $rb_detail->fk_support_lembur = $reimbursement->id;
                $rb_detail->save();
            }
        }
        return redirect()->route('karyawan.reimbursement')->with('success', 'Data berhasil diajukan!');
    }
    public function print_reimbursement($id)
    {
        $reimbursement = AdminReimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Cetak Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_karyawan.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,
            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            $results_TS = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($timesheet_project_detail as $item) {
                $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_karyawan.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail,
                'results_TS' => $results_TS,
                'total_TS' => $total_TS,

            ]);
        } elseif ($reimbursement->halaman == 'ST') {
            $title = 'Lihat Support Ticket';
            $support_ticket_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_ticket_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_karyawan.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_ticket_detail' => $support_ticket_detail,
                'results' => $results,
                'total' => $total
            ]);
        } elseif ($reimbursement->halaman == 'SL') {
            $title = 'Lihat Support Lembur';
            $support_lembur_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_lembur_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_karyawan.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function lihat_bukti_reimbursement($id)
    {
        $reimbursement = AdminReimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Bukti Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();

            return view('halaman_karyawan.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat Bukti Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            return view('halaman_karyawan.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail
            ]);
        }
    }
    public function view_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = AdminReimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_karyawan.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,
            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            $results_TS = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($timesheet_project_detail as $item) {
                $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_karyawan.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail,
                'results_TS' => $results_TS,
                'total_TS' => $total_TS,

            ]);
        } elseif ($reimbursement->halaman == 'ST') {
            $title = 'Lihat Support Ticket';
            $support_ticket_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_ticket_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_karyawan.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_ticket_detail' => $support_ticket_detail,
                'results' => $results,
                'total' => $total
            ]);
        } elseif ($reimbursement->halaman == 'SL') {
            $title = 'Lihat Support Lembur';
            $support_lembur_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_lembur_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_karyawan.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
}
