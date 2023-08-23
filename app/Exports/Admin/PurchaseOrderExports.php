<?php

namespace App\Exports\Admin;

use Carbon\Carbon;
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
        $PO = DB::table('admin_purchase_order')->find($this->id);
        $PO_Nominal = DB::table('admin_purchase_order')->where('id', $this->id)->get();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->sum('nominal');
        $results = [];
        foreach ($PO_Nominal as $item) {
            $result = ($item->PPN / 100) * $nominal_PO;
            $PPH = ($item->PPH / 100) * $nominal_PO;
            $PPH_4 = ($item->PPH_4 / 100) * $nominal_PO;
            $ctm_2 = ($item->ctm_2 / 100) * $nominal_PO;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH - $PPH_4 - $ctm_2;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');

        return view('exports.purchase_order', [
            'PO' => $PO,
            'PO_detail' => $PO_detail,
            'nominal' => $nominal_PO,
            'PPN' => $result,
            'PPH' => $PPH,
            'PPH_4' => $PPH_4,
            'grand_total' => $grand_total,
            'tgl_purchasing' => $formattedDate
        ]);
    }
}
