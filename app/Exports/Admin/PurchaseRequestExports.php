<?php

namespace App\Exports\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseRequestExports implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $PR = DB::table('admin_purchase_request')->where('id', $this->id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $this->id)->get();
        return view('exports.purchase_request', [
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
}
