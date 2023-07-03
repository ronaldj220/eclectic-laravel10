<?php

namespace App\Exports\Kasir;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ReimbursementExport implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $dataReimbursement = DB::table('admin_reimbursement')->get();
        $halamanReimbursement = DB::table('admin_reimbursement')->find($this->id);
        $dataRbDetail = DB::table('admin_rb_detail')->where('fk_rb', $this->id)->get();
        $nominal = DB::table('admin_rb_detail')->where('fk_rb', $this->id)->sum('nominal'); // Menghitung total nominal dari semua detail

        // Data Timesheet Project
        $dataTSDetail = DB::table('admin_timesheet_project_detail')->where('fk_timesheet_project', $this->id)->get();
        $results_TS = []; // Array untuk menyimpan hasil perhitungan masing-masing item

        foreach ($dataTSDetail as $item) {
            $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
            $results_TS[] = $result; // Tambahkan hasil ke array
        }
        $total_TS = array_sum($results_TS);

        // Data Support Ticket
        $dataSTDetail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $this->id)->get();
        $results_ST = []; // Array untuk menyimpan hasil perhitungan masing-masing item

        foreach ($dataSTDetail as $item) {
            $result = $item->nominal_awal * $item->jam;
            $results_ST[] = $result; // Tambahkan hasil ke array
        }

        $total_ST = array_sum($results_ST);

        // Data Support Lembur
        $dataSLDetail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $this->id)->get();
        $results_SL = []; // Array untuk menyimpan hasil perhitungan masing-masing item

        foreach ($dataSLDetail as $item) {
            $result = $item->nominal_awal * $item->jam;
            $results_SL[] = $result; // Tambahkan hasil ke array
        }

        $total_SL = array_sum($results_SL);
        return view('exports.kasir.reimbursement', [
            // Untuk Reimbursement
            'reimbursement' => $dataReimbursement,
            'halaman_reimbursement' => $halamanReimbursement,
            'rb_detail' => $dataRbDetail,
            'nominal' => $nominal,
            // Untuk Timesheet Support
            'ts_detail' => $dataTSDetail,
            'hasil_ts' => $results_TS,
            'nominal_ts' => $total_TS,
            // Untuk Support Ticket
            'st_detail' => $dataSTDetail,
            'hasil_st' => $results_ST,
            'nominal_st' => $total_ST,
            // Untuk Support Lembur
            'sl_detail' => $dataSLDetail,
            'hasil_sl' => $results_SL,
            'nominal_sl' => $total_SL,
        ]);
    }
}
