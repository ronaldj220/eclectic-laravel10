<?php

namespace App\Exports\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class CashAdvanceExport implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $dataCA = DB::table('admin_cash_advance')->where('id', $this->id)->first();
        $nominal = DB::table('admin_cash_advance')->where('id', $this->id)->sum('nominal');
        return view('exports.cash_advance', [
            'cash_advance' => $dataCA,
            'nominal' => $nominal
        ]);
    }
}
