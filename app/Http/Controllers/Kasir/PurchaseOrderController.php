<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\PurchaseOrderExports;
use App\Http\Controllers\Controller;
use App\Models\Admin\Purchase_Order;
use App\Models\Admin\Purchase_Order_Detail;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Purchase Order';
        $kasir = Auth::user()->nama;
        if ($request->has('search')) {
            $dataPO = DB::table('admin_purchase_order as a')
                ->select(
                    'a.id',
                    'a.no_doku',
                    'a.tgl_purchasing',
                    'b.id as id_pr',
                    'b.no_doku as tipe_pr',
                    'a.supplier',
                    'a.pemohon',
                    'a.status_approved',
                    'a.status_paid'
                )
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_order_detail as d')
                        ->whereColumn('a.id', 'd.fk_po')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_request as b', 'a.tipe_pr', '=', 'b.no_doku')
                ->where('a.supplier', 'LIKE', '%' . $request->search . '%')
                ->orWhere('d.judul', 'LIKE', '%' . $request->search . '%')
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
                ->orderBy('tgl_purchasing', 'desc')
                ->orderBy('a.no_doku', 'desc')
                ->paginate(100);
        } elseif ($request->has('bulan')) {
            $query = DB::table('admin_purchase_order as a')
                ->select('a.id', 'a.no_doku', 'a.tgl_purchasing', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.supplier', 'a.status_approved', 'a.status_paid')
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_order_detail as d')
                        ->whereColumn('a.id', 'd.fk_po')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_request as b', 'a.tipe_pr', '=', 'b.no_doku')
                ->orderBy('no_doku', 'desc');

            // Memeriksa apakah parameter bulan dikirimkan dalam request POST
            if ($request->has('bulan')) {
                $bulan = $request->bulan;
                $query->whereMonth('tgl_purchasing', date('m', strtotime($bulan)))
                    ->whereYear('tgl_purchasing', date('Y', strtotime($bulan)));
            }

            $dataPO = $query->paginate(100);
        } else {
            $dataPO = DB::table('admin_purchase_order as a')
                ->select('a.id', 'a.no_doku', 'a.tgl_purchasing', 'b.id as id_pr', 'b.no_doku as tipe_pr', 'a.supplier', 'a.status_approved', 'a.status_paid')
                ->selectSub(function ($query) {
                    $query->select('judul')
                        ->from('admin_purchase_order_detail as d')
                        ->whereColumn('a.id', 'd.fk_po')
                        ->limit(1);
                }, 'judul')
                ->leftJoin('admin_purchase_request as b', 'a.tipe_pr', '=', 'b.no_doku')
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
                ->orderBy('a.tgl_purchasing', 'desc')
                ->orderBy('a.no_doku', 'desc')
                ->orderByRaw("CASE WHEN a.status_approved = 'approved' AND a.status_paid = 'pending' THEN 0 WHEN a.status_approved = 'pending' OR a.status_paid = 'pending' THEN 1 WHEN a.status_approved = 'pending' OR a.status_paid = 'paid' THEN 2 END, CASE WHEN a.pemohon = 'Suzy. A' THEN 1 ELSE 2 END")
                ->paginate(20);
        }
        return view('halaman_finance.purchase_order.index', [
            'title' => $title,
            'PO' => $dataPO
        ]);
    }
    public function view_PO($id)
    {
        $title = 'Lihat Purchase Order';
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

        return view('halaman_finance.purchase_order.view_PO', [
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
    public function view_PR($id)
    {
        $title = 'Lihat PR';
        $PR = DB::table('admin_purchase_request')->where('id', $id)->first();
        $PR_detail = DB::table('admin_purchase_request_detail')->where('fk_pr', $id)->get();

        return view('halaman_finance.purchase_order.view_PR', [
            'title' => $title,
            'PR' => $PR,
            'PR_detail' => $PR_detail

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
            'no_referensi' => $request->no_ref,
            'tgl_bayar' => Carbon::now()
        ]);
        $no_doku = $data->no_doku;
        return redirect()->route('kasir.purchase_order')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }

    public function tambah_PO()
    {
        $title = 'Tambah Purchase Order';
        $AWAL = 'PO';

        $bulanRomawi = array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $noUrutAkhir = DB::table('admin_purchase_order')->whereMonth('tgl_purchasing', '=', date('m'))->count();
        $no = 1;
        // dd($noUrutAkhir);
        $no_dokumen = null;
        if (date('j') == 1) {
            $no_dokumen = sprintf("%02s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
            } else {
                $no_dokumen = sprintf("%02s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
            }
        }
        $karyawan = Auth::user()->nama;
        $tipe_pr = DB::select('SELECT * FROM admin_purchase_request WHERE pemohon = ?', [$karyawan]);
        $pemohon = DB::select('SELECT * FROM karyawan');
        $accounting = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 2)
            ->get();
        $kasir = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 3)
            ->get();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        $kurs = DB::select('SELECT * FROM kurs');

        $supplier = DB::select('SELECT * FROM supplier WHERE PIC = ?', [$karyawan]);

        return view('halaman_finance.purchase_order.tambah_PO', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'pemohon' => $pemohon,
            'tipe_pr' => $tipe_pr,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $kurs,
            'supplier' => $supplier,
        ]);
    }
    public function getDataBySupplier(Request $request)
    {
        $supplier = $request->input('supplier');
        $pemohonMenyetujuiData = DB::table('supplier')->where('nama_supplier', $supplier)->first();
        if ($pemohonMenyetujuiData) {
            // Menggabungkan data pemohon dan menyetujui ke dalam satu array
            $data = [
                'pemohon' => $pemohonMenyetujuiData->PIC,
                'menyetujui' => $pemohonMenyetujuiData->menyetujui,
            ];

            // Mengirim data pemohon dan menyetujui ke tampilan sebagai respons JSON
            return response()->json($data);
        } else {
            // Jika data tidak ditemukan, mengirim respons JSON dengan data kosong
            return response()->json([]);
        }
    }
    public function getDataByPR(Request $request)
    {
        $tipePR = $request->input('tipe_pr');

        $details = DB::table('admin_purchase_request')
            ->join('admin_purchase_request_detail', 'admin_purchase_request.id', '=', 'admin_purchase_request_detail.fk_pr')
            ->where('admin_purchase_request.no_doku', $tipePR)
            ->get();

        if ($details->count() > 0) {
            // Menggabungkan data keterangan, jumlah, dan qty ke dalam satu array
            $keterangan = [];
            $jumlah = [];
            $qty = [];

            foreach ($details as $detail) {
                $keterangan[] = $detail->judul;
                $jumlah[] = $detail->jumlah;
                $qty[] = $detail->satuan;
            }

            $data = [
                'keterangan' => $keterangan,
                'jumlah' => $jumlah,
                'qty' => $qty,
            ];

            // Mengirim data ke tampilan sebagai respons JSON
            return response()->json($data);
        } else {
            // Jika data tidak ditemukan, mengirim respons JSON dengan data kosong
            return response()->json([]);
        }
    }
    public function simpan_PO(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $PO = new Purchase_Order();
        $PO->no_doku = $request->no_doku;
        $PO->tgl_purchasing = $tgl_diajukan;
        $PO->tipe_pr = $request->tipe_pr;
        $PO->supplier = $request->supplier;
        $PO->pemohon = $request->pemohon;
        $PO->accounting = $request->accounting;
        $PO->kasir = $request->kasir;
        $PO->menyetujui = $request->menyetujui;
        $PO->save();

        foreach ($request->ket as $keterangan => $value) {
            $PO_detail = new Purchase_Order_Detail();
            $PO_detail->judul = $value;
            $PO_detail->jumlah = $request->jum[$keterangan];
            $PO_detail->satuan = $request->qty[$keterangan];
            $PO_detail->curr = $request->kurs[$keterangan];
            $PO_detail->nominal = $request->nom[$keterangan];
            $PO_detail->PPN = isset($request->vat[$keterangan]) ? ($request->vat[$keterangan]) : null;
            $PO_detail->PPH = isset($request->pph[$keterangan]) ? ($request->pph[$keterangan]) : null;
            $PO_detail->PPH_4 = isset($request->pph_4[$keterangan]) ? ($request->pph_4[$keterangan]) : null;
            $PO_detail->PPH_21 = isset($request->pph_21[$keterangan]) ? ($request->pph_21[$keterangan]) : null;
            $PO_detail->diskon = isset($request->diskon[$keterangan]) ? ($request->diskon[$keterangan]) : null;
            $PO_detail->ctm_1 = isset($request->lain_lain[$keterangan]) ? ($request->lain_lain[$keterangan]) : null;
            $PO_detail->ctm_2 = isset($request->lain_lain_nom[$keterangan]) ? ($request->lain_lain_nom[$keterangan]) : null;
            $PO_detail->fk_po = $PO->id;

            $PO_detail->save();
        }
        return redirect()->route('kasir.purchase_order')->with('success', 'Data Purchase Order berhasil disimpan.');
    }
    public function excel_PO($id)
    {
        return Excel::download(new PurchaseOrderExports($id), 'PO_Kasir_' . $id . '.xlsx');
    }
}
