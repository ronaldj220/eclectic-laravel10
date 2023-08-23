<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rb_Detail;
use App\Models\Admin\Reimbursement;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;


class ReimbursementController extends Controller
{
    public function index()
    {
        $title = 'Reimbursement';
        $menyetujui = Auth::guard('direksi')->user()->nama;
        $dataReimbursement = DB::table('admin_reimbursement')
            ->where(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where(function ($query) {
                        $query->where('status_approved', 'rejected')
                            ->orWhere('status_paid', 'rejected');
                    });
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'paid');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', '<>', $menyetujui)
                    ->where('status_approved', 'rejected')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', '<>', $menyetujui)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->where(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->orWhere('menyetujui', $menyetujui);
            })
            ->orderByRaw("CASE WHEN status_approved = 'pending' AND status_paid = 'pending' THEN 0 WHEN status_approved = 'pending' OR status_paid = 'pending' THEN 1 ELSE 2 END, CASE WHEN pemohon = 'Yacob' THEN 1 ELSE 2 END")
            ->paginate(10);

        return view('halaman_direksi.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement
        ]);
    }
    public function view_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_direksi.reimbursement.view_reimbursement', [
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
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_direksi.reimbursement.view_reimbursement', [
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

            return view('halaman_direksi.reimbursement.view_reimbursement', [
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

            return view('halaman_direksi.reimbursement.view_reimbursement', [
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
            $dataKaryawan = DB::table('karyawan')->select('nama', 'bank', 'no_rekening', 'signature')->first();



            return view('halaman_direksi.reimbursement.lihat_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,
                'karyawan' => $dataKaryawan
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
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_direksi.reimbursement.lihat_reimbursement', [
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

            return view('halaman_direksi.reimbursement.lihat_reimbursement', [
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

            return view('halaman_direksi.reimbursement.lihat_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function print_bukti_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Bukti Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();

            return view('halaman_direksi.reimbursement.view_bukti_reimbursement', [
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
    public function setujui_reimbursement($id)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            if ($data->halaman == 'RB') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                    'tgl_persetujuan' => Carbon::now()
                ]);
            } elseif ($data->halaman == 'TS') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                    'tgl_persetujuan' => Carbon::now()

                ]);
            } elseif ($data->halaman == 'ST') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                    'tgl_persetujuan' => Carbon::now()


                ]);
            } elseif ($data->halaman == 'SL') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                    'tgl_persetujuan' => Carbon::now()

                ]);
            }
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('direksi.beranda')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_reimbursement($id, Request $request)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            if ($data->halaman == 'RB') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'TS') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'ST') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'SL') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'alasan' => $request->alasan
                ]);
            }
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan Reimbursement yang berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.beranda')->with('gagal', $e->getMessage());
        }
    }
    public function tambah_RB()
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

        $userRole = Auth::guard('direksi')->user()->jabatan;
        $userRoleJSON = json_encode($userRole);

        return view('halaman_direksi.reimbursement.tambah_RB', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'userRoleJSON' => $userRoleJSON
        ]);
    }
    public function simpan_RB(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $reimbursement = new Reimbursement();
        $reimbursement->no_doku_real = $request->no_doku;
        $reimbursement->tgl_diajukan = $tgl_diajukan;
        $reimbursement->judul_doku = $request->judul_doku;
        $reimbursement->pemohon = $request->pemohon;
        $reimbursement->accounting = $request->accounting;
        $reimbursement->kasir = $request->kasir;
        $reimbursement->menyetujui = $request->nama_menyetujui;
        $reimbursement->no_telp_direksi = $request->no_telp;
        if ($request->project === 'RB (Reimbursement)') {
            $reimbursement->halaman = 'RB';
        }

        $reimbursement->save();

        if ($request->project === 'RB (Reimbursement)') {
            foreach ($request->deskripsi as $deskripsi => $value) {
                $rb_detail = new Rb_Detail();
                $rb_detail->deskripsi = $value;

                if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                    $file = $request->file('foto')[$deskripsi];

                    // Menyimpan gambar asli tanpa kompresi
                    $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('bukti_RB_admin'), $filePath);
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
        }
        return redirect()->route('direksi.reimbursement')->with('success', 'Data berhasil diajukan!');
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
