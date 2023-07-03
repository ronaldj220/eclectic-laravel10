<?php

namespace App\Exports\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;


class PurchaseOrderExports implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $dataPO = DB::table('admin_purchase_order')->where('id', $this->id)->first();
        $dataPO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->sum('nominal');
        $VAT = DB::select('SELECT * FROM master_po');
        $total = 0;

        foreach ($VAT as $item) {
            $total += $item->VAT * $nominal_PO;
        }

        $total += $nominal_PO;

        return view('exports.purchase_order', [
            'PO' => $dataPO,
            'PO_detail' => $dataPO_detail,
            'nominal' => $nominal_PO,
            'VAT' => $VAT,
            'total' => $total
        ]);
    }
}
