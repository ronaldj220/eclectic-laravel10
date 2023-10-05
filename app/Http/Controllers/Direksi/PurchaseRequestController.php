<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Request;
use App\Models\Admin\Purchase_Request_Detail;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $title = 'PR';
        $menyetujui = Auth::user()->nama;
        $dataPR = DB::table('admin_purchase_request as a')
            ->where('a.pemohon', $menyetujui)
            ->select('a.id', 'a.no_doku', 'a.tgl_diajukan', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.pemohon', 'a.status_approved', 'a.status_paid')
            ->leftJoin('admin_purchase_order as b', 'a.no_doku', '=', 'b.tipe_pr')
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('a.status_approved', 'pending')
                    ->where('a.status_paid', 'pending')
                    ->where('a.menyetujui', $menyetujui);
            })
            ->orderByRaw("CASE 
    WHEN a.status_approved = 'pending' AND a.status_paid = 'pending' THEN 0
    WHEN a.status_approved = 'rejected' AND a.status_paid = 'rejected' THEN 1
    WHEN a.pemohon = 'Yacob' THEN 2 
    ELSE 3 
END")
            ->orderBy('a.tgl_diajukan', 'desc')
            ->orderBy('a.no_doku', 'desc')
            ->paginate(20);

        return view('halaman_direksi.purchase_request.index', [
            'title' => $title,
            'PR' => $dataPR
        ]);
    }
    public function view_PR($id)
    {
        $title = 'Lihat PR';
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();
        return view('halaman_direksi.purchase_request.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function view_PO($id)
    {
        $title = 'Lihat PO';
        $PO = DB::table('admin_purchase_order')->find($id);
        $PO_Nominal = DB::table('admin_purchase_order')->where('id', $id)->get();
        $PO_detail = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->get();
        $nominal_PO = DB::table('admin_purchase_order_detail')->where('fk_po', $id)->sum('nominal');
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

        return view('halaman_direksi.purchase_request.view_PO', [
            'title' => $title,
            'PO' => $PO,
            'PO_detail' => $PO_detail,
            'nominal' => $nominal_PO,
            'PPN' => $result,
            'PPH' => $PPH,
            'PPH_4' => $PPH_4,
            'ctm_2' => $ctm_2,
            'grand_total' => $grand_total,
            'tgl_purchasing' => $formattedDate
        ]);
    }
    public function setujui_PR($id)
    {
        try {
            DB::table('admin_purchase_request')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending',
                'tgl_approval' => Carbon::now()
            ]);
            $data = DB::table('admin_purchase_request')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('direksi.purchase_request')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.purchase_request')->with('gagal', $e->getMessage());
        }
    }

    public function tolak_PR($id, Request $request)
    {
        try {
            DB::table('admin_purchase_request')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'alasan' => $request->alasan
            ]);
            $data = DB::table('admin_purchase_request')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('direksi.purchase_request')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan PR yang baru!');
        } catch (\Exception $e) {
            return redirect()->route('direksi.purchase_request')->with('gagal', $e->getMessage());
        }
    }
    public function tambah_PR()
    {
        $title = 'Tambah Purchase Request';
        $AWAL = 'PR';

        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_purchase_request')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if (date('j') == 1) {
            $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($no));
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
            } else {
                $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($no));
            }
        }
        $userLoggedIn = Auth::user()->nama;
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->where('nama', '!=', $userLoggedIn)
            ->orderBy('nama', 'asc')
            ->get();
        return view('halaman_direksi.purchase_request.tambah_PR', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'menyetujui' => $menyetujui
        ]);
    }
    public function simpan_PR(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $PR = new Purchase_Request();
        $PR->no_doku = $request->no_doku;
        $PR->tgl_diajukan = $tgl_diajukan;
        $PR->pemohon = $request->pemohon;
        $PR->menyetujui = $request->nama_menyetujui;

        $PR->save();

        foreach ($request->ket as $keterangan => $value) {
            $PR_detail = new Purchase_Request_Detail();
            $PR_detail->judul = $value;
            $PR_detail->tgl_1 = isset($request->tgl_1[$keterangan]) ? $request->tgl_1[$keterangan] : null;
            $PR_detail->tgl_2 = isset($request->tgl_2[$keterangan]) ? $request->tgl_2[$keterangan] : null;
            $PR_detail->jumlah = $request->jum[$keterangan];
            $PR_detail->satuan = $request->qty[$keterangan];
            $PR_detail->tgl_pakai = $request->tgl_pakai[$keterangan];
            $PR_detail->project = isset($request->project[$keterangan]) ? $request->project[$keterangan] : null;
            $PR_detail->fk_pr = $PR->id;

            $PR_detail->save();
        }

        return redirect()->route('direksi.purchase_request')->with('success', 'Data PR berhasil disimpan.');
    }
}
