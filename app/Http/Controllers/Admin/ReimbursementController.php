<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\ReimbursementExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rb_Detail;
use App\Models\Admin\Reimbursement;
use App\Models\Admin\Support_Lembur_Detail;
use App\Models\Admin\Support_Ticket_Detail;
use App\Models\Admin\Timesheet_Project_Detail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;

class ReimbursementController extends Controller
{
    public function index()
    {
        $title = 'Reimbursement';
        $dataReimbursement = DB::table('admin_reimbursement')
            ->orderBy('tgl_diajukan', 'desc')
            ->orderBy('no_doku', 'desc')
            ->paginate(10);

        // $dataRBMenyetujui = DB::table('admin_reimbursement')->first();
        return view('halaman_admin.admin.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement,
            // 'menyetujui' => $dataRBMenyetujui
        ]);
    }
    public function search_by_date(Request $request)
    {
        $title = 'Reimbursement';
        $query = DB::table('admin_reimbursement')
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

        $dataReimbursement = $query->paginate(10);

        return view('halaman_admin.admin.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement
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
    public function tambah_reimbursement()
    {
        $title = 'Tambah Reimbursement';
        $AWAL = 'RB';

        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_reimbursement')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        $no_dokumen = null;
        $currentMonth = date('n');

        if (date('j') == 1) { // Cek jika tanggal saat ini adalah tanggal 1
            $no_dokumen = sprintf("%05s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%05s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            } else {
                $no_dokumen = sprintf("%05s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            }
        }
        $accounting = DB::select('SELECT * FROM accounting');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::select('SELECT * FROM karyawan ORDER BY nama ASC');
        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');
        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');
        // dd($no_dokumen);

        return view('halaman_admin.admin.reimbursement.tambah_reimbursement', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'nominal_awal' => $nominal_awal,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases
        ]);
    }

    public function simpan_reimbursement(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $reimbursement = new Reimbursement();
        $reimbursement->no_doku = $request->no_doku;
        $reimbursement->tgl_diajukan = $tgl_diajukan;
        $reimbursement->judul_doku = $request->judul_doku;
        $reimbursement->pemohon = $request->pemohon;
        $reimbursement->accounting = $request->accounting;
        $reimbursement->kasir = $request->kasir;
        $reimbursement->menyetujui = $request->nama_menyetujui;
        $reimbursement->no_telp_direksi = $request->no_telp;

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
                $file->move(public_path('bukti_TS_admin/'), $fileName);
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
                $file->move(public_path('bukti_ST_admin/'), $fileName);
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
                $file->move(public_path('bukti_SL_admin/'), $fileName);
                $reimbursement->bukti_support_lembur = $fileName;
            }
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
                $nominal = ($rb_detail->nominal_awal / $rb_detail->hari_awal) * $rb_detail->hari;
                $rb_detail->nominal = $nominal;
                $rb_detail->fk_timesheet_project = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'ST (Support Ticket)') {
            foreach ($request->deskripsi_st as $index => $deskripsi_st) {
                $rb_detail = new Support_Ticket_Detail();
                $rb_detail->deskripsi = $deskripsi_st;
                $rb_detail->curr = $request->kurs_st[$index];
                $rb_detail->nominal = $request->nom_st[$index];
                $rb_detail->fk_support_ticket = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'SL (Support Lembur)') {
            foreach ($request->deskripsi_sl as $index => $deskripsi_sl) {
                $rb_detail = new Support_Lembur_Detail();
                $rb_detail->deskripsi = $deskripsi_sl;
                $rb_detail->curr = $request->kurs_sl[$index];
                $rb_detail->nominal = $request->nom_sl[$index];
                $rb_detail->fk_support_lembur = $reimbursement->id;
                $rb_detail->save();
            }
        }

        return redirect()->route('admin.reimbursement')->with('success', 'Data Reimbursement berhasil disimpan.');
    }
    public function excel_reimbursement($id)
    {
        return Excel::download(new ReimbursementExport($id), 'reimbursement_' . $id . '.xlsx');
    }
    public function view_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_admin.admin.reimbursement.view_reimbursement', [
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
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results_TS[] = round($result); // Tambahkan hasil ke array
            }
            $total_TS = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->sum('nominal');
            return view('halaman_admin.admin.reimbursement.view_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.view_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function setujui_reimbursement($id)
    {
        try {
            DB::table('admin_reimbursement')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan! Mohon Menunggu Persetujuan dari Direktur!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
        }
    }

    public function lihat_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');


            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
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
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results_TS[] = round($result); // Tambahkan hasil ke array
            }
            $total_TS = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->sum('nominal');
            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function print_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
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
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results_TS[] = round($result); // Tambahkan hasil ke array
            }
            $total_TS = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->sum('nominal');
            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
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

            $total_SL = array_sum($results);

            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total_SL
            ]);
        }
    }
    public function print_bukti_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Bukti Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();

            return view('halaman_admin.admin.reimbursement.print_bukti_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail
            ]);
        }
    }
    public function edit_reimbursement($id)
    {
        $reimbursement = DB::table('admin_reimbursement')->where('id', $id)->first();
        $title = 'Edit Reimbursement';
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::select('SELECT * FROM karyawan');
        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');
        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');

        return view('halaman_admin.admin.reimbursement.edit_reimbursement', [
            'title' => $title,
            'reimbursement' => $reimbursement,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'nominal_awal' => $nominal_awal,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases
        ]);
    }
    public function update_reimbursement(Request $request, $id)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        DB::table('admin_reimbursement')
            ->where('id', $id)
            ->update([
                'no_doku' => $request->no_doku,
                'tgl_diajukan' => $tgl_diajukan,
                'judul_doku' => $request->judul_doku,
                'pemohon' => $request->pemohon,
                'accounting' => $request->accounting,
                'kasir' => $request->kasir,
                'menyetujui' => $request->nama_menyetujui
            ]);



        if ($request->project === 'RB (Reimbursement)') {
            foreach ($request->deskripsi as $deskripsi => $value) {
                $rb_detail = [
                    'deskripsi' => $value,
                    'no_bukti' => $request->nobu[$deskripsi],
                    'curr' => $request->kurs_rb[$deskripsi],
                    'nominal' => $request->nom_rb[$deskripsi],
                    'tanggal_1' => $request->tgl1[$deskripsi],
                    'tanggal_2' => isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null,
                    'keperluan' => $request->keperluan[$deskripsi],
                    'fk_rb' => $id
                ];

                if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                    $files = $request->file('foto');

                    $file = $files[$deskripsi];
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . $deskripsi . '.' . $fileExtension;
                    $filePath = public_path('bukti_reim/') . $fileName;

                    $file->move(public_path('bukti_reim/'), $filePath);

                    $rb_detail['bukti_reim'] = $fileName;
                }
                DB::table('admin_rb_detail')
                    ->where('fk_rb', $id)
                    ->update($rb_detail);
            }
        } elseif ($request->project === 'TS (Timesheet Support)') {
            foreach ($request->karyawan_ts as $index => $nama_karyawan) {
                $nominal_awal = $request->nom_ts[$index];
                $hari_awal = $request->hari_ts1[$index];
                $hari = $request->hari_ts2[$index];

                // Perhitungan pembagian
                $nominal_per_hari = $nominal_awal / $hari_awal;
                $nominal_per_hari_total = $nominal_per_hari * $hari;
                $rb_detail = [
                    'nama_karyawan' => $nama_karyawan,
                    'curr' => $request->kurs_ts[$index],
                    'nominal_awal' => $request->nom_ts[$index],
                    'hari_awal' => $request->hari_ts1[$index],
                    'hari' => $request->hari_ts2[$index],
                    'nominal' => $nominal_per_hari_total,
                    'fk_timesheet_project' => $id
                ];
                DB::table('admin_timesheet_project_detail')
                    ->where('fk_timesheet_project', $id)
                    ->update($rb_detail);
            }
        } elseif ($request->project === 'ST (Support Ticket)') {
            foreach ($request->karyawan_st as $index => $karyawan_st) {
                $rb_detail = [
                    'nama_karyawan' => $karyawan_st,
                    'aliases' => $request->project_st[$index],
                    'curr' => $request->kurs_st[$index],
                    'nominal_awal' => $request->nom_st[$index],
                    'jam' => $request->jam_st[$index],
                    'fk_support_ticket' => $id
                ];
                DB::table('admin_support_ticket_detail')
                    ->where('fk_support_ticket', $id)
                    ->update($rb_detail);
            }
        } elseif ($request->project === 'SL (Support Lembur)') {
            foreach ($request->karyawan_st as $index => $karyawan_st) {
                $rb_detail = [
                    'nama_karyawan' => $karyawan_st,
                    'aliases' => $request->project_sl[$index],
                    'curr' => $request->kurs_sl[$index],
                    'nominal' => $request->nom_sl[$index],
                    'fk_support_lembur' => $id
                ];
                DB::table('admin_support_lembur_detail')
                    ->where('fk_support_lembur', $id)
                    ->update($rb_detail);
            }
        }

        return redirect()->route('admin.reimbursement')->with('success', 'Data Reimbursement berhasil diperbarui.');
    }
    public function kirim_WA($id)
    {
        $reimbursement = DB::table('admin_reimbursement')->find($id);

        $nomorTelepon = [
            $reimbursement->no_telp_direksi,
        ];

        // Membangun pesan yang diinginkan
        $pesan = "[Ini Adalah Pesan Otomatis]\nAda Permohonan RB No. " . $reimbursement->no_doku . " Dari " . $reimbursement->pemohon . " Menunggu Approval. \nKlik Disini untuk Melihat ";

        $urlWhatsApp = 'https://api.whatsapp.com/send';

        $berhasilDikirim = [];

        foreach ($nomorTelepon as $nomor) {
            try {
                $url = $urlWhatsApp . '?phone=' . $nomor . '&text=' . urlencode($pesan);

                // Lakukan pengiriman pesan dengan membuka URL menggunakan fungsi file_get_contents atau CURL
                // Misalnya:
                // $response = file_get_contents($url);

                // Jika pengiriman pesan berhasil, tambahkan nomor ke dalam array berhasilDikirim
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
