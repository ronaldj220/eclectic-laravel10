<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Request;
use App\Models\Admin\Purchase_Request_Detail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Purchase Request';
        $karyawan = Auth::guard('karyawan')->user()->nama;
        if ($request->has('search')) {
            $data_PR = DB::table('admin_purchase_request')
                ->where('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orderBy('no_doku', 'asc')
                ->whereIn('status_approved', ['rejected', 'pending', 'approved'])
                ->whereIn('status_paid', ['pending', 'rejected', 'paid'])
                ->paginate(20);
        }
        $data_PR = DB::table('admin_purchase_request')
            ->where('pemohon', $karyawan)
            ->orderBy('no_doku', 'asc')
            ->whereIn('status_approved', ['rejected', 'pending', 'approved'])
            ->whereIn('status_paid', ['pending', 'rejected', 'paid'])
            ->paginate(10);
        return view('halaman_karyawan.purchase_request.index', [
            'title' => $title,
            'PR' => $data_PR
        ]);
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

        return view('halaman_karyawan.purchase_request.tambah_PR', [
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

        return redirect()->route('karyawan.purchase_request')->with('success', 'Data PR berhasil disimpan.');
    }

    public function view_PR($id)
    {
        $title = 'Lihat Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_karyawan.purchase_request.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
}
