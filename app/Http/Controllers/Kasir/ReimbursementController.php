<?php

namespace App\Http\Controllers\Kasir;

use App\Exports\Kasir\ReimbursementExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rb_Detail;
use App\Models\Admin\Reimbursement;
use App\Models\Admin\Support_Lembur_Detail;
use App\Models\Admin\Support_Ticket_Detail;
use App\Models\Admin\Timesheet_Project_Detail;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Voice;

class ReimbursementController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Reimbursement';
        $kasir = Auth::guard('kasir')->user()->nama;
        if ($request->has('search')) {
            $dataReimbursement = DB::table('admin_reimbursement')
                ->where('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tgl_diajukan', 'desc')
                ->orderBy('no_doku_real', 'desc')
                ->whereIn('status_approved', ['approved'])
                ->whereIn('status_paid', ['pending'])
                ->paginate(1000);
        } elseif ($request->has('bulan')) {
            $query = DB::table('admin_reimbursement')
                ->orderBy('no_doku_real', 'asc')
                ->orderByRaw("
            CASE
                WHEN status_approved = 'approved' THEN 1
                WHEN status_approved = 'pending' THEN 2
                WHEN status_approved = 'rejected' THEN 3
                ELSE 4
            END
        ");
            $bulan = $request->bulan;
            $query->whereMonth('tgl_diajukan', date('m', strtotime($bulan)))
                ->whereYear('tgl_diajukan', date('Y', strtotime($bulan)));
            $dataReimbursement = $query->paginate(100);
        } else {
            $dataReimbursement = DB::table('admin_reimbursement')
                ->orderBy('tgl_diajukan', 'desc')
                ->orderBy('no_doku_real', 'desc')
                ->whereIn('status_approved', ['approved', 'rejected'])
                ->whereIn('status_paid', ['pending', 'rejected'])
                ->where('kasir', $kasir)
                ->orWhere('pemohon', $kasir)
                ->paginate(20);
        }
        return view('halaman_finance.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement
        ]);
    }

    public function excel_reimbursement($id)
    {
        return Excel::download(new ReimbursementExport($id), 'reimbursement_kasir_' . $id . '.xlsx');
    }
    public function view_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_finance.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,

            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            $results_TS = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($timesheet_project_detail as $item) {
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_finance.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail,
                'results_TS' => $results_TS,
                'total_TS' => $total_TS,

            ]);
        } elseif ($reimbursement->halaman == 'ST') {
            $title = 'Lihat Support Ticket';
            $support_ticket_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_ticket_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_finance.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_ticket_detail' => $support_ticket_detail,
                'results' => $results,
                'total' => $total
            ]);
        } elseif ($reimbursement->halaman == 'SL') {
            $title = 'Lihat Support Lembur';
            $support_lembur_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_lembur_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_finance.reimbursement.view_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function print_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');
            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,

            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            $results_TS = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($timesheet_project_detail as $item) {
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail,
                'results_TS' => $results_TS,
                'total_TS' => $total_TS,

            ]);
        } elseif ($reimbursement->halaman == 'ST') {
            $title = 'Lihat Support Ticket';
            $support_ticket_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_ticket_detail as $item) {
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_ticket_detail' => $support_ticket_detail,
                'results' => $results,
                'total' => $total
            ]);
        } elseif ($reimbursement->halaman == 'SL') {
            $title = 'Lihat Support Lembur';
            $support_lembur_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_lembur_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function print_bukti_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Cetak Bukti Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();

            return view('halaman_finance.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Cetak Bukti Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            return view('halaman_finance.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail
            ]);
        }
    }
    public function bayar_reimbursement($id)
    {
        // Data Reimbursement
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Bayar Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_finance.reimbursement.bayar_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,

            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat Timesheet Support';
            // Data Timesheet Project
            $timesheet_project_detail = DB::table('admin_timesheet_project_detail')
                ->where('fk_timesheet_project', $id)
                ->get();

            $results_TS = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($timesheet_project_detail as $item) {
                if ($item->hari >= 19) {
                    $result = $item->nominal_awal;
                } else {
                    $result = ($item->nominal_awal / $item->hari_awal) * $item->hari;
                }
                $results_TS[] = $result; // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail,
                'results_TS' => $results_TS,
                'total_TS' => $total_TS,

            ]);
        } elseif ($reimbursement->halaman == 'ST') {
            $title = 'Lihat Support Ticket';
            $support_ticket_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_ticket_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_ticket_detail' => $support_ticket_detail,
                'results' => $results,
                'total' => $total
            ]);
        } elseif ($reimbursement->halaman == 'SL') {
            $title = 'Lihat Support Lembur';
            $support_lembur_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_lembur_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_finance.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total
            ]);
        }
    }
    public function paid_RB($id, Request $request)
    {
        $data = DB::table('admin_reimbursement')->find($id);
        DB::table('admin_reimbursement')->where('id', $id)->update([
            'status_approved' => 'approved',
            'status_paid' => 'paid',
            'no_referensi' => $request->no_ref,
            'tgl_bayar' => Carbon::now()
        ]);
        $no_doku = $data->no_doku_real;
        return redirect()->route('kasir.beranda')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dibayar!');
    }
    public function tambah_RB()
    {
        $title = 'Tambah Reimbursement';

        $accounting = DB::select('SELECT * FROM accounting');
        $karyawan = DB::select('SELECT * FROM karyawan');
        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');
        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');
        $kasir = DB::select('SELECT * from kasir');
        $menyetujui = DB::select('SELECT * from menyetujui');

        $currency = DB::select('SELECT * FROM kurs');

        $userRole = Auth::guard('kasir')->user()->jabatan;
        $userRoleJSON = json_encode($userRole);

        return view('halaman_finance.reimbursement.tambah_RB', [
            'title' => $title,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'karyawan' => $karyawan,
            'kurs' => $currency,
            'userRoleJSON' => $userRoleJSON,
            'nominal_awal' => $nominal_awal,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases,
        ]);
    }
    // Generate new Numbering Document
    public function new_no_doku()
    {
        $AWAL = 'RB';

        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_reimbursement')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        $no_dokumen = null;
        $currentMonth = date('n');

        if (date('j') == 1) { // Cek jika tanggal saat ini adalah tanggal 1
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%05s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            } else {
                $no_dokumen = sprintf("%05s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            }
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%05s", abs($noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            } else {
                $no_dokumen = sprintf("%05s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            }
        }
        return $no_dokumen;
    }
    public function new_updated_no_doku()
    {
        $AWAL = 'RB';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $currentMonth = date('n');
        $latestSubmittedDoc = Reimbursement::where('status_approved', '!=', 'hold')
            ->where('status_paid', '!=', 'hold')
            ->whereMonth('tgl_diajukan', '=', now()->format('m'))
            ->whereYear('tgl_diajukan', '=', now()->format('Y'))
            ->orderBy('no_doku_real', 'desc')
            ->first();

        $newDocNumber = 1; // Nomor default jika belum ada dokumen yang disubmit

        if ($latestSubmittedDoc) {
            $newDocNumber = intval($latestSubmittedDoc->no_doku_real) + 1;
        }

        return str_pad($newDocNumber, 5, '0', STR_PAD_LEFT) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
    }
    public function simpan_RB(Request $request)
    {
        if ($request->input('draftAction') == 'true') {
            // Tombol "Draft" ditekan
            // Lakukan tindakan yang sesuai untuk pengajuan
            $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
            $tgl_diajukan = $tanggal->format('Y-m-d');

            $reimbursement = new Reimbursement();
            $reimbursement->no_doku_real = null;
            $reimbursement->no_doku_draft = $this->new_no_doku();
            $reimbursement->tgl_diajukan = $tgl_diajukan;
            $reimbursement->judul_doku = $request->judul_doku;
            $reimbursement->pemohon = $request->pemohon;
            $reimbursement->accounting = $request->accounting;
            $reimbursement->kasir = $request->kasir;
            $reimbursement->menyetujui = $request->nama_menyetujui;
            $reimbursement->no_telp_direksi = $request->no_telp;
            $reimbursement->halaman = 'RB';

            // Menentukan status apabila save as draft
            $reimbursement->status_approved = 'hold';
            $reimbursement->status_paid = 'hold';
            $reimbursement->save();

            foreach ($request->deskripsi as $deskripsi => $value) {
                $rb_detail = new Rb_Detail();
                $rb_detail->deskripsi = $value;

                if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                    $file = $request->file('foto')[$deskripsi];

                    // Menyimpan gambar asli tanpa kompresi
                    $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('bukti_RB_admin'), $filePath);
                    $fileName = basename($filePath);

                    $rb_detail->bukti_reim = $fileName;
                }

                $rb_detail->no_bukti = $request->nobu[$deskripsi];
                $rb_detail->curr = $request->kurs_rb[$deskripsi];
                $rb_detail->nominal = $request->nom_rb[$deskripsi];
                $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                $rb_detail->keperluan = $request->project[$deskripsi];
                $rb_detail->fk_rb = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->input('submitAction') == 'true') {
            // Tombol "Draft" ditekan
            // Lakukan tindakan yang sesuai untuk penyimpanan draft
            $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
            $tgl_diajukan = $tanggal->format('Y-m-d');

            $reimbursement = new Reimbursement();
            $reimbursement->no_doku_real = $this->new_no_doku();
            $reimbursement->no_doku_draft = null;
            $reimbursement->tgl_diajukan = $tgl_diajukan;
            $reimbursement->judul_doku = $request->judul_doku;
            $reimbursement->pemohon = $request->pemohon;
            $reimbursement->accounting = $request->accounting;
            $reimbursement->kasir = $request->kasir;
            $reimbursement->menyetujui = $request->nama_menyetujui;
            $reimbursement->no_telp_direksi = $request->no_telp;
            $reimbursement->halaman = 'RB';

            // Menentukan status apabila save as draft
            $reimbursement->status_approved = 'rejected';
            $reimbursement->status_paid = 'rejected';
            $reimbursement->save();

            foreach ($request->deskripsi as $deskripsi => $value) {
                $rb_detail = new Rb_Detail();
                $rb_detail->deskripsi = $value;

                if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                    $file = $request->file('foto')[$deskripsi];

                    // Menyimpan gambar asli tanpa kompresi
                    $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('bukti_RB_admin'), $filePath);
                    $fileName = basename($filePath);

                    $rb_detail->bukti_reim = $fileName;
                }

                $rb_detail->no_bukti = $request->nobu[$deskripsi];
                $rb_detail->curr = $request->kurs_rb[$deskripsi];
                $rb_detail->nominal = $request->nom_rb[$deskripsi];
                $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                $rb_detail->keperluan = $request->project[$deskripsi];
                $rb_detail->fk_rb = $reimbursement->id;
                $rb_detail->save();
            }
        } else {
            // Tidak ada tombol yang ditekan
            return "No action detected.";
        }
        return redirect()->route('kasir.reimbursement')->with('success', 'Data berhasil diajukan!');
    }
    public function edit_RB($id)
    {
        $title = 'Edit Reimbursement';
        $reimbursement = Reimbursement::find($id);
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::table('karyawan')
            ->select('nama')
            ->union(DB::table('menyetujui')->select('nama'))
            ->union(DB::table('kasir')->select('nama'))
            ->orderBy('nama')
            ->get();
        $menyetujui = DB::select('SELECT * from menyetujui ORDER by nama ASC');
        $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
        $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

        return view('halaman_finance.reimbursement.edit_RB', [
            'title' => $title,
            'reimbursement' => $reimbursement,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'menyetujui' => $menyetujui,
            'rb_detail' => $rb_detail,
            'nominal' => $nominal,

        ]);
    }
    public function update_doc_RB(Request $request, $id)
    {
        if ($request->input('draftAction') == 'true') {
            try {
                $data = DB::table('admin_reimbursement')->where('id', $id)->first();
                $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
                $tgl_diajukan = $tanggal->format('Y-m-d');

                $reimbursement = [
                    'no_doku_real' => null,
                    'no_doku_draft' => $request->no_doku,
                    'tgl_diajukan' => $tgl_diajukan,
                    'judul_doku' => $request->judul_doku,
                    'pemohon' => $request->pemohon,
                    'accounting' => $request->accounting,
                    'kasir' => $request->kasir,
                    'menyetujui' => $request->nama_menyetujui,
                    'no_telp_direksi' => $request->no_telp,
                    'halaman' => 'RB',
                    'status_approved' => 'hold',
                    'status_paid' => 'hold'
                ];

                DB::table('admin_reimbursement')->where('id', $id)->update($reimbursement);

                foreach ($request->deskripsi as $deskripsi => $value) {
                    if ($request->flag[$deskripsi] == 'u') {
                        $idItem = $request->id[$deskripsi];
                        $rb_detail = Rb_Detail::find($idItem);
                        $rb_detail->deskripsi = $value;

                        if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                            $file = $request->file('foto')[$deskripsi];

                            // Menyimpan gambar asli tanpa kompresi
                            $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('bukti_RB_admin'), $filePath);
                            $fileName = basename($filePath);

                            $rb_detail->bukti_reim = $fileName;
                        }

                        $rb_detail->no_bukti = $request->nobu[$deskripsi];
                        $rb_detail->curr = $request->kurs_rb[$deskripsi];
                        $rb_detail->nominal = $request->nom_rb[$deskripsi];
                        $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                        $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                        $rb_detail->keperluan = $request->project[$deskripsi];
                        $rb_detail->fk_rb = $id;

                        // $rbDetails[] = $rb_detail;
                        $rb_detail->save();
                    } elseif ($request->flag[$deskripsi] == 'i') {
                        $rb_detail = new Rb_Detail();
                        $rb_detail->deskripsi = $value;

                        if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                            $file = $request->file('foto')[$deskripsi];

                            // Menyimpan gambar asli tanpa kompresi
                            $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('bukti_RB_admin'), $filePath);
                            $fileName = basename($filePath);

                            $rb_detail->bukti_reim = $fileName;
                        }

                        $rb_detail->no_bukti = $request->nobu[$deskripsi];
                        $rb_detail->curr = $request->kurs_rb[$deskripsi];
                        $rb_detail->nominal = $request->nom_rb[$deskripsi];
                        $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                        $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                        $rb_detail->keperluan = $request->project[$deskripsi];
                        $rb_detail->fk_rb = $id;

                        // $rbDetails[] = $rb_detail;
                        $rb_detail->save();
                    }
                }
                $no_doku = $data->no_doku_draft;
                return redirect()->route('kasir.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return redirect()->route('kasir.reimbursement')->with('gagal', $e->getMessage());
            }
        } elseif ($request->input('submitAction') == 'true') {
            try {
                $data = DB::table('admin_reimbursement')->where('id', $id)->first();
                $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
                $tgl_diajukan = $tanggal->format('Y-m-d');

                $reimbursement = [
                    'no_doku_real' => $this->new_updated_no_doku(),
                    'no_doku_draft' => null,
                    'tgl_diajukan' => $tgl_diajukan,
                    'judul_doku' => $request->judul_doku,
                    'pemohon' => $request->pemohon,
                    'accounting' => $request->accounting,
                    'kasir' => $request->kasir,
                    'menyetujui' => $request->nama_menyetujui,
                    'no_telp_direksi' => $request->no_telp,
                    'halaman' => 'RB',
                    'status_approved' => 'rejected',
                    'status_paid' => 'rejected'
                ];

                DB::table('admin_reimbursement')->where('id', $id)->update($reimbursement);

                foreach ($request->deskripsi as $deskripsi => $value) {
                    if ($request->flag[$deskripsi] == 'u') {
                        $idItem = $request->id[$deskripsi];
                        $rb_detail = Rb_Detail::find($idItem);
                    } elseif ($request->flag[$deskripsi] == 'i') {
                        $rb_detail = new Rb_Detail();
                    }
                    $rb_detail->deskripsi = $value;

                    if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                        $file = $request->file('foto')[$deskripsi];

                        // Menyimpan gambar asli tanpa kompresi
                        $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('bukti_RB_admin'), $filePath);
                        $fileName = basename($filePath);

                        $rb_detail->bukti_reim = $fileName;
                    }

                    $rb_detail->no_bukti = $request->nobu[$deskripsi];
                    $rb_detail->curr = $request->kurs_rb[$deskripsi];
                    $rb_detail->nominal = $request->nom_rb[$deskripsi];
                    $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                    $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                    $rb_detail->keperluan = $request->project[$deskripsi];
                    $rb_detail->fk_rb = $id;

                    // $rbDetails[] = $rb_detail;
                    $rb_detail->save();
                }
                $no_doku = $data->no_doku_real;
                return redirect()->route('kasir.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return redirect()->route('kasir.reimbursement')->with('gagal', $e->getMessage());
            }
        }
    }

    public function delete_RB($id)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            $RB = DB::table('admin_reimbursement')->where('id', $id);
            $RB->delete();

            $RB_detail = DB::table('admin_rb_detail')->where('fk_rb', $id);
            $RB_detail->delete();

            $halaman = $data->halaman;
            // dd($no_doku);
            return redirect()->route('kasir.reimbursement')->with('success', 'Data ' . $halaman . ' berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('kasir.reimbursement')->with('error', $e->getMessage());
        }
    }
    public function getNomor(Request $request)
    {
        $menyetujui = $request->input('menyetujui');

        $details = DB::table('menyetujui')->where('nama', $menyetujui)->get();

        if ($details->count() > 0) {

            foreach ($details as $detail) {
                $no_telp[] = $detail->no_telp;
            }

            $data = [
                'keterangan' => $no_telp,
            ];

            // Mengirim data ke tampilan sebagai respons JSON
            return response()->json($data);
        } else {
            // Jika data tidak ditemukan, mengirim respons JSON dengan data kosong
            return response()->json([]);
        }
    }
}
