<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Request;
use App\Models\Admin\Purchase_Request_Detail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $title = 'Purchase Request';
        $menyetujui = Auth::guard('direksi')->user()->nama;
        $dataPR = DB::table('admin_purchase_request')
            ->where(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'approved')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where(function ($query) {
                        $query->where('status_approved', 'rejected')
                            ->orWhere('status_paid', 'rejected');
                    });
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', '<>', $menyetujui)
                    ->where('status_approved', 'rejected')
                    ->where('status_paid', 'pending');
            })
            ->orWhere(function ($query) use ($menyetujui) {
                $query->where('pemohon', '<>', $menyetujui)
                    ->where('status_approved', 'pending')
                    ->where('status_paid', 'pending');
            })
            ->where(function ($query) use ($menyetujui) {
                $query->where('pemohon', $menyetujui)
                    ->orWhere('menyetujui', $menyetujui);
            })
            ->orderByRaw("CASE WHEN status_approved = 'pending' AND status_paid = 'pending' THEN 0 WHEN status_approved = 'pending' OR status_paid = 'pending' THEN 1 ELSE 2 END, CASE WHEN pemohon = 'Yacob' THEN 1 ELSE 2 END")
            ->paginate(10);

        return view('halaman_direksi.purchase_request.index', [
            'title' => $title,
            'PR' => $dataPR
        ]);
    }
    public function view_PR($id)
    {
        $title = 'Lihat Purchase Request';
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();
        return view('halaman_direksi.purchase_request.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
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
            return redirect()->route('direksi.purchase_request')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan! Tunggu Pembayaran ya!');
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
        $menyetujui = DB::select('SELECT * FROM menyetujui');
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
