<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\Admin\Reimbursement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReimbursementController extends Controller
{
    public function index()
    {
        $title = 'Reimbursement';
        $menyetujui = Auth::guard('direksi')->user()->nama;
        $dataReimbursement = DB::table('admin_reimbursement')
            ->where('status_approved', 'pending')
            ->where('status_paid', 'pending')
            ->where('menyetujui', $menyetujui)

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
            $dataKaryawan = DB::table('karyawan')->select('nama', 'bank', 'no_rekening', 'signature')->first();
            $direksi = DB::table('menyetujui')
                ->where('id', $id)
                ->pluck('signature')
                ->first();
            $dataUser = DB::table('users')->select('no_rekening', 'bank')->first();

            return view('halaman_direksi.reimbursement.view_reimbursement', [
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
                $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
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
                $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
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
            return redirect()->route('direksi.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui. Tunggu Pembayaran ya!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.reimbursement')->with('gagal', $e->getMessage());
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
            return redirect()->route('direksi.reimbursement')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan Reimbursement yang berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.reimbursement')->with('gagal', $e->getMessage());
        }
    }
    public function tambah_RB()
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
    }
}
