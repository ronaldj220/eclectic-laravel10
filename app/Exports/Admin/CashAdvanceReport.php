<?php

namespace App\Exports\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class CashAdvanceReport implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $dataCAR = DB::table('admin_cash_advance_report')->where('id', $this->id)->first();
        $dataCARDetail = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $this->id)->get();
        $nominal = DB::table('admin_cash_advance_report_detail')->where('fk_ca', $this->id)->sum('nominal');
        return view('exports.cash_advance_report', [
            'cash_advance_report' => $dataCAR,
            'CARDetail' => $dataCARDetail,
            'nominal' => $nominal
        ]);
    }
}
