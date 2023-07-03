<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $title = 'Purchase Order';
        $dataPO = DB::table('admin_purchase_order')
            ->whereIn('status_approved', ['approved'])
            ->whereIn('status_paid', ['pending'])
            ->paginate(10);
        return view('halaman_finance.purchase_order.index', [
            'title' => $title,
            'PO' => $dataPO
        ]);
    }
    public function view_PO($id)
    {
        $title = 'Lihat Purchase Order';
        $PO = DB::table('admin_purchase_order')->where('id', $id)->first();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $PO_Detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $results = [];
        foreach ($PO_Detail as $item) {
            $result = ($item->PPN / 100) * $item->nominal;
            $PPH = ($item->PPH / 100) * $item->nominal;
            $PPH_4 = ($item->PPH_4 / 100) * $item->nominal;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');

        return view('halaman_finance.purchase_order.view_PO', [
            'title' => $title,
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
    public function print_PO($id)
    {
        $title = 'Cetak Purchase Order';
        $PO = DB::table('admin_purchase_order')->where('id', $id)->first();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $PO_Detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $results = [];
        foreach ($PO_Detail as $item) {
            $result = ($item->PPN / 100) * $item->nominal;
            $PPH = ($item->PPH / 100) * $item->nominal;
            $PPH_4 = ($item->PPH_4 / 100) * $item->nominal;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');

        return view('halaman_finance.purchase_order.print_PO', [
            'title' => $title,
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

    public function bayar_PO($id)
    {
        $title = 'Bayar Purchase Order';
        $PO = DB::table('admin_purchase_order')->where('id', $id)->first();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
        $PO_Detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $results = [];
        foreach ($PO_Detail as $item) {
            $result = ($item->PPN / 100) * $item->nominal;
            $PPH = ($item->PPH / 100) * $item->nominal;
            $PPH_4 = ($item->PPH_4 / 100) * $item->nominal;
            $results[] = $result; // Tambahkan hasil ke array
        }
        $grand_total = $nominal_PO + $result - $PPH;


        $carbonDate = Carbon::createFromFormat('Y-m-d', $PO->tgl_purchasing)->locale('id');
        $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');

        return view('halaman_finance.purchase_order.bayar_PO', [
            'title' => $title,
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
    public function paid_PO($id, Request $request)
    {
        $data = DB::table('admin_purchase_order')->find($id);
        DB::table('admin_purchase_order')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.purchase_order')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
}
