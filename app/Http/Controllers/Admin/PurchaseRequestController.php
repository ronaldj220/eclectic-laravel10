<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\PurchaseRequest;
use App\Exports\Admin\PurchaseRequestExports;
use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Request;
use App\Models\Admin\Purchase_Request_Detail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class PurchaseRequestController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Purchase Request';
        if ($request->has('search')) {
            $searchTerm = $request->search;

            $data_PR = DB::table('admin_purchase_request as a')
                ->select('a.id', 'a.no_doku', 'a.tgl_diajukan', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.pemohon', 'a.status_approved', 'a.status_paid')
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_request_detail as d')
                        ->where('a.id', 'd.fk_pr')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_order as b', 'a.no_doku', '=', 'b.tipe_pr')
                ->where('a.pemohon', 'LIKE', '%' . $request->search . '%')
                ->orderBy('a.no_doku', 'desc')
                ->paginate(20);
        } else {
            $data_PR = DB::table('admin_purchase_request as a')
                ->select('a.id', 'a.no_doku', 'a.tgl_diajukan', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.pemohon', 'a.status_approved', 'a.status_paid')
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_request_detail as d')
                        ->whereColumn('a.id', 'd.fk_pr')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_order as b', 'a.no_doku', '=', 'b.tipe_pr')
                ->orderBy('a.no_doku', 'desc')
                ->paginate(20);
        }

        return view('halaman_admin.admin.purchase_request.index', [
            'title' => $title,
            'purchase_request' => $data_PR
        ]);
    }
    public function search_by_date(Request $request)
    {
        $title = 'Purchase Request';
        $bulan = $request->input('bulan'); // Ambil nilai bulan dari input form
        // Pisahkan nilai bulan dan tahun dari input bulan
        list($tahun, $bulan) = explode('-', $bulan);

        $data_PR = DB::table('admin_purchase_request as a')
            ->select('a.id', 'a.no_doku', 'a.tgl_diajukan', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.pemohon', 'a.status_approved', 'a.status_paid')
            ->selectSub(function ($query) {
                $query->select('judul')
                    ->from('admin_purchase_request_detail as d')
                    ->whereColumn('a.id', 'd.fk_pr')
                    ->limit(1);
            }, 'judul')
            ->leftJoin('admin_purchase_order as b', 'a.no_doku', '=', 'b.tipe_pr')
            ->whereMonth('tgl_diajukan', $bulan)
            ->whereYear('tgl_diajukan', $tahun)
            ->orderBy('a.no_doku', 'desc')
            ->paginate(100);



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
        $noUrutAkhir = DB::table('admin_purchase_request')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if ($noUrutAkhir) {
            $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        } else {
            $no_dokumen = date('y') . '/' . $bulanRomawi[date('n')] . '/' . $AWAL . '/' . sprintf("%05s", abs($no));
        }

        $pemohon = DB::table('karyawan')
            ->select('nama')
            ->union(DB::table('menyetujui')->select('nama'))
            ->union(DB::table('kasir')->select('nama'))
            ->orderBy('nama')
            ->get();
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

        return view('halaman_admin.admin.purchase_request.view_PO', [
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
    public function acc_PR($id)
    {
        try {
            DB::table('admin_purchase_request')->where('id', $id)->update([
                'status_approved' => 'approved',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_purchase_request')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.purchase_request')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase_request')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_PR($id)
    {
        try {
            DB::table('admin_purchase_request')->where('id', $id)->update([
                'status_approved' => 'rejected',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_purchase_request')->where('id', $id)->first();
            $no_doku = $data->no_doku;
            return redirect()->route('admin.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui! Mohon Ajukan Dokumen yang Berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase_request')->with('gagal', $e->getMessage());
        }
    }
    public function edit_PR($id)
    {
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->first();
        $title = 'Edit Purchase Request';
        $menyetujui = DB::select('SELECT * from menyetujui');

        return view('halaman_admin.admin.purchase_request.edit_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail,
            'menyetujui' => $menyetujui
        ]);
    }
    public function update_PR(Request $request, $id)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');
        DB::table('admin_purchase_request')->where('id', $id)->update([
            'no_doku' => $request->no_doku,
            'tgl_diajukan' => $tgl_diajukan,
            'pemohon' => $request->pemohon,
            'menyetujui' => $request->nama_menyetujui
        ]);

        foreach ($request->ket as $keterangan => $value) {
            DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->update([
                'judul' => $value,
                'tgl_1' => isset($request->tgl_1[$keterangan]) ? $request->tgl_1[$keterangan] : null,
                'tgl_2' => isset($request->tgl_2[$keterangan]) ? $request->tgl_2[$keterangan] : null,
                'jumlah' => $request->jum[$keterangan],
                'satuan' => $request->qty[$keterangan],
                'tgl_pakai' => $request->tgl_pakai[$keterangan],
                'project' =>  isset($request->project[$keterangan]) ? $request->project[$keterangan] : null,
                'fk_pr' => $id
            ]);
        }
        return redirect()->route('admin.purchase_request')->with('success', 'Data PR berhasil diperbarui.');
    }
}
