<?php

namespace App\Exports\Kasir;

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
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->sum('nominal');
        $PO_Detail = DB::table('admin_purchase_order_detail')->where('fk_po', $this->id)->get();
        $results = [];
        foreach ($PO_Detail as $item) {
            $result = ($item->PPN / 100) * $item->nominal;
            $PPH = ($item->PPH / 100) * $item->nominal;
            $PPH_4 = ($item->PPH_4 / 100) * $item->nominal;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH - $PPH_4;


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
