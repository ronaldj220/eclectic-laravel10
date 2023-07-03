<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $title = 'Purchase Order';
        $menyetujui = Auth::guard('direksi')->user()->nama;
        $dataPO = DB::table('admin_purchase_order')
            ->orderByDesc('no_doku')
            ->whereIn('status_approved', ['pending'])
            ->whereIn('status_paid', ['pending'])
            ->where('menyetujui', $menyetujui)
            ->paginate(10);
        return view('halaman_direksi.purchase_order.index', [
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

        return view('halaman_direksi.purchase_order.view_PO', [
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

    public function setujui_PO($id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
                'tgl_approval' => Carbon::now()
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.purchase_order')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan! Tunggu Pembayaran ya!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.purchase_order')->with('gagal', $e->getMessage());
        }
    }

    public function tolak_PO(Request $request, $id)
    {
        try {
            DB::table('admin_purchase_order')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $data = DB::table('admin_purchase_order')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.purchase_order')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . '. Mohon Ajukan PO yang berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.purchase_order')->with('gagal', $e->getMessage());
        }
    }
}
