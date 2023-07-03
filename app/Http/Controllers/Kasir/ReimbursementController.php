<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\ReimbursementExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReimbursementController extends Controller
{
    public function index()
    {
        $title = 'Reimbursement';
        $dataReimbursement = DB::table('admin_reimbursement')
            ->where('status_approved', 'approved')
            ->where('status_paid', 'pending')
            ->paginate(10);
        return view('halaman_finance.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement
        ]);
    }
    public function excel_reimbursement($id)
    {
        return Excel::download(new ReimbursementExport($id), 'reimbursement_kasir_' . $id . '.xlsx');
    }
    public function view_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_finance.reimbursement.view_reimbursement', [
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
            return view('halaman_finance.reimbursement.view_reimbursement', [
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

            return view('halaman_finance.reimbursement.view_reimbursement', [
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

            return view('halaman_finance.reimbursement.view_reimbursement', [
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
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');
            return view('halaman_finance.reimbursement.print_reimbursement', [
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
            return view('halaman_finance.reimbursement.print_reimbursement', [
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

            return view('halaman_finance.reimbursement.print_reimbursement', [
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

            return view('halaman_finance.reimbursement.print_reimbursement', [
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
            $title = 'Cetak Bukti Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();

            return view('halaman_finance.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Cetak Bukti Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            return view('halaman_finance.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail
            ]);
        }
    }
    public function bayar_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Bayar Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');
            $dataKaryawan = DB::table('karyawan')->select('nama', 'bank', 'no_rekening', 'signature')->first();
            $direksi = DB::table('menyetujui')
                ->where('id', $id)
                ->pluck('signature')
                ->first();
            $dataUser = DB::table('users')->select('no_rekening', 'bank')->first();

            return view('halaman_finance.reimbursement.bayar_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,
                'karyawan' => $dataKaryawan,
                'direksi' => $direksi,
                'user' => $dataUser
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
            return view('halaman_finance.reimbursement.print_reimbursement', [
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

            return view('halaman_finance.reimbursement.print_reimbursement', [
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

            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function paid_RB($id, Request $request)
    {
        $data = DB::table('admin_reimbursement')->find($id);
        DB::table('admin_reimbursement')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
}
