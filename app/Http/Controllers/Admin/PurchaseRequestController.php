<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\PurchaseRequest;
use App\Exports\Admin\PurchaseRequestExports;
use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Request;
use App\Models\Admin\Purchase_Request_Detail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $title = 'Purchase Request';
        $data_PR = DB::table('admin_purchase_request')
            ->orderBy('no_doku', 'desc')
            ->paginate(10);
        return view('halaman_admin.admin.purchase_request.index', [
            'title' => $title,
            'purchase_request' => $data_PR
        ]);
    }
    public function tambah_purchase_request()
    {
        $title = 'Tambah Purchase Request';
        $AWAL = 'PR';

        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_purchase_request')->max('id');
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if ($noUrutAkhir) {
            $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        } else {
            $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($no));
        }

        $pemohon = DB::select('SELECT * FROM karyawan');
        $menyetujui = DB::select('SELECT * FROM menyetujui');
        return view('halaman_admin.admin.purchase_request.tambah_purchase_request', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'pemohon' => $pemohon,
            'menyetujui' => $menyetujui
        ]);
    }
    public function simpan_purchase_request(Request $request)
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

        return redirect()->route('admin.purchase_request')->with('success', 'Data PR berhasil disimpan.');
    }
    public function excel_purchase_request($id)
    {
        return Excel::download(new PurchaseRequestExports($id), 'PR_' . $id . '.xlsx');
    }
    public function print_purchase_request($id)
    {
        $title = 'Cetak Purchase Request';
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();
        return view('halaman_admin.admin.purchase_request.print_purchase_request', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function view_PR($id)
    {
        $title = 'Lihat Purchase Request';
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_admin.admin.purchase_request.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function setujui_PR($id)
    {
        try {
            DB::table('admin_purchase_request')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_purchase_request')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.purchase_request')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan! Mohon Menunggu Persetujuan dari Direktur!');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase_request')->with('gagal', $e->getMessage());
        }
    }
}
