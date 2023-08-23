<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\PurchaseRequestExports;
use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Request;
use App\Models\Admin\Purchase_Request_Detail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseRequestController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Purchase Request';
        $kasir = Auth::guard('kasir')->user()->nama;
        if ($request->has('search')) {
            $dataPR = DB::table('admin_purchase_request as a')
                ->select(
                    'a.id',
                    'a.no_doku',
                    'a.tgl_diajukan',
                    'b.id as id_pr',
                    'b.no_doku as tipe_pr',
                    'a.pemohon',
                    'a.status_approved',
                    'a.status_paid'
                )
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_request_detail as d')
                        ->whereColumn('a.id', 'd.fk_pr')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_order as b', 'a.no_doku', '=', 'b.tipe_pr')
                ->where('a.pemohon', 'LIKE', '%' . $request->search . '%')
                ->orWhere('b.supplier', 'LIKE', '%' . $request->search . '%')
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('a.pemohon', 'Suzy. A')
                            ->where('a.status_approved', 'approved')
                            ->where('a.status_paid', 'pending');
                    })
                        ->orWhere(function ($query) {
                            $query->where('a.pemohon', 'Suzy. A')
                                ->where(function ($query) {
                                    $query->where('a.status_approved', 'rejected')
                                        ->orWhere('a.status_paid', 'rejected');
                                });
                        })
                        ->orWhere(function ($query) {
                            $query->where('a.pemohon', 'Suzy. A')
                                ->where('a.status_approved', 'pending')
                                ->where('a.status_paid', 'pending');
                        })
                        ->orWhere(function ($query) {
                            $query->where('a.pemohon', '<>', 'Suzy. A')
                                ->where('a.status_approved', 'approved')
                                ->where('a.status_paid', 'pending');
                        })
                        ->orWhere(function ($query) {
                            $query->where('a.pemohon', '<>', 'Suzy. A')
                                ->where('a.status_approved', 'approved')
                                ->where('a.status_paid', 'paid');
                        })
                        ->orWhere(function ($query) {
                            $query->where('a.pemohon', '<>', 'Suzy. A')
                                ->where('a.status_approved', 'pending')
                                ->where('a.status_paid', 'pending');
                        })
                        ->orWhere('a.pemohon', 'Suzy. A')
                        ->orWhere(function ($query) {
                            $query->where('a.status_approved', 'approved')
                                ->where('a.status_paid', 'pending');
                        });
                })
                ->orderByRaw("CASE WHEN a.status_approved = 'approved' AND a.status_paid = 'pending' THEN 0 WHEN a.status_approved = 'pending' OR a.status_paid = 'pending' THEN 1 ELSE 2 END, CASE WHEN a.pemohon = 'Suzy. A' THEN 1 ELSE 2 END")
                ->orderBy('a.no_doku', 'desc')
                ->paginate(100);
        } elseif ($request->has('bulan')) {
            $bulan = $request->input('bulan'); // Ambil nilai bulan dari input form
            // Pisahkan nilai bulan dan tahun dari input bulan
            list($tahun, $bulan) = explode('-', $bulan);

            $dataPR = DB::table('admin_purchase_request as a')
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
        } else {
            $dataPR = DB::table('admin_purchase_request as a')
                ->where(function ($query) use ($kasir) {
                    $query->where('a.pemohon', $kasir)
                        ->where('a.status_approved', 'approved')
                        ->where('a.status_paid', 'pending');
                })
                ->orWhere(function ($query) use ($kasir) {
                    $query->where('a.pemohon', $kasir)
                        ->where(function ($query) {
                            $query->where('a.status_approved', 'rejected')
                                ->orWhere('a.status_paid', 'rejected');
                        });
                })
                ->orWhere(function ($query) use ($kasir) {
                    $query->where('a.pemohon', $kasir)
                        ->where('a.status_approved', 'pending')
                        ->where('a.status_paid', 'pending');
                })
                ->orWhere(function ($query) use ($kasir) {
                    $query->where('a.pemohon', '<>', $kasir)
                        ->where('a.status_approved', 'approved')
                        ->where('a.status_paid', 'pending');
                })
                ->orWhere(function ($query) use ($kasir) {
                    $query->where('a.pemohon', '<>', $kasir)
                        ->where('a.status_approved', 'approved')
                        ->where('a.status_paid', 'paid');
                })
                ->orWhere(function ($query) use ($kasir) {
                    $query->where('a.pemohon', '<>', $kasir)
                        ->where('a.status_approved', 'pending')
                        ->where('a.status_paid', 'pending');
                })
                ->where(function ($query) use ($kasir) {
                    $query->where('a.pemohon', $kasir);
                })
                ->orWhere(function ($query) {
                    $query->where('a.status_approved', 'approved')
                        ->where('a.status_paid', 'pending');
                })
                ->select('a.id', 'a.no_doku', 'a.tgl_diajukan', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.pemohon', 'a.status_approved', 'a.status_paid')
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_request_detail as d')
                        ->whereColumn('a.id', 'd.fk_pr')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_order as b', 'a.no_doku', '=', 'b.tipe_pr')
                ->orderBy('a.no_doku', 'desc')
                ->orderByRaw("CASE WHEN a.status_approved = 'approved' AND a.status_paid = 'pending' THEN 0 WHEN a.status_approved = 'pending' OR a.status_paid = 'pending' THEN 1 ELSE 2 END, CASE WHEN a.pemohon = 'Suzy. A' THEN 1 ELSE 2 END")
                ->paginate(20);
        }
        return view('halaman_finance.purchase_request.index', [
            'title' => $title,
            'PR' => $dataPR
        ]);
    }
    public function view_PR($id)
    {
        $title = 'Lihat Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_request.view_PR', [
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

        return view('halaman_finance.purchase_request.view_PO', [
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
    public function print_PR($id)
    {
        $title = 'Cetak Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_request.print_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function bayar_PR($id)
    {
        $title = 'Bayar Purchase Request';
        $PR = DB::table('admin_purchase_request')->find($id);
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_request.bayar_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail
        ]);
    }
    public function paid_PR($id, Request $request)
    {
        $data = DB::table('admin_purchase_request')->find($id);
        DB::table('admin_purchase_request')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.purchase_request')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
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

        return view('halaman_finance.purchase_request.tambah_PR', [
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
        return redirect()->route('kasir.purchase_request')->with('success', 'Data PR berhasil disimpan.');
    }
    public function excel_PR($id)
    {
        return Excel::download(new PurchaseRequestExports($id), 'PR_kasir' . $id . '.xlsx');
    }
}
