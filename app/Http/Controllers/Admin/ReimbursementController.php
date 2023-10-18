<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\ReimbursementExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rb_Detail;
use App\Models\Admin\Reimbursement;
use App\Models\Admin\Support_Lembur_Detail;
use App\Models\Admin\Support_Ticket_Detail;
use App\Models\Admin\Timesheet_Project_Detail;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReimbursementController extends Controller
{
    public function index(Request $request)
    {
        $title = 'RB';

        $sortColumn = 'tgl_diajukan'; // Kolom untuk pengurutan
        $sortDirection = 'desc'; // Arah pengurutan (desc untuk descending, asc untuk ascending)
        $sortColumn2 = 'no_doku_real';
        $sortDirection2 = 'desc';

        if ($request->has('search')) {
            $dataReimbursement = DB::table('admin_reimbursement')
                ->where('judul_doku', 'LIKE', '%' . $request->search . '%')
                ->orWhere('pemohon', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tgl_diajukan', 'desc')
                ->orderBy('no_doku_real', 'desc')
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

            // Memeriksa apakah parameter bulan dikirimkan dalam request POST
            if ($request->has('bulan')) {
                $bulan = $request->bulan;
                $query->whereMonth('tgl_diajukan', date('m', strtotime($bulan)))
                    ->whereYear('tgl_diajukan', date('Y', strtotime($bulan)));
            }

            $dataReimbursement = $query->paginate(100);
        } else {
            $dataReimbursement = DB::table('admin_reimbursement')
                ->where('status_approved', '<>', 'hold')
                ->where('status_paid', '<>', 'hold')

                ->orderBy($sortColumn, $sortDirection)
                ->orderBy($sortColumn2, $sortDirection2)
                ->paginate(20);
        }
        // $dataRBMenyetujui = DB::table('admin_reimbursement')->first();
        return view('halaman_admin.admin.reimbursement.index', [
            'title' => $title,
            'reimbursement' => $dataReimbursement,
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
    public function new_no_doku_updated()
    {
        $AWAL = 'RB';

        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = DB::table('admin_reimbursement')->whereMonth('tgl_diajukan', '=', date('m'))->count();
        $no = 1;
        $no_dokumen = null;
        $currentMonth = date('n');

        if (date('j') == 1) { // Cek jika tanggal saat ini adalah tanggal 1
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%05s", abs($noUrutAkhir)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            } else {
                $no_dokumen = sprintf("%05s", abs($no)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
            }
        } else {
            if ($noUrutAkhir) {
                $no_dokumen = sprintf("%05s", abs($noUrutAkhir)) . '/' . $AWAL . '/' . $bulanRomawi[$currentMonth] . '/' . date('y');
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

    public function new_doc_RB()
    {
        $title = 'Tambah RB';
        // $no_dokumen = $this->new_num_generated();
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
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = User::all();
        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');
        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');

        return view('halaman_admin.admin.reimbursement.new_doc_RB', [
            'title' => $title,
            // 'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'nominal_awal' => $nominal_awal,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases
        ]);
    }
    public function save_no_doku_RB(Request $request)
    {
        $request->validate([
            'judul_doku' => ['required'],
        ], [
            'judul_doku.required' => 'Judul Dokumen tidak boleh kosong',
        ]);

        $validator = Validator::make($request->all(), [
            'project.*' => 'required'
        ], [
            'project.*.required' => 'Project ke-:index harap diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('submitAction') == 'true') {
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

                $rb_detail->bukti_reim = null;

                $rb_detail->no_bukti = $request->nobu[$deskripsi];
                $rb_detail->curr = $request->kurs_rb[$deskripsi];
                $rb_detail->nominal = $request->nom_rb[$deskripsi];
                $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                $rb_detail->keperluan = $request->project[$deskripsi];
                $rb_detail->fk_rb = $reimbursement->id;
                $rb_detail->save();
            }

            return redirect()->route('admin.reimbursement')->with('success', 'Data RB berhasil diajukan!');
        }
    }
    public function edit_doc_RB($id)
    {
        $title = 'Edit RB';
        $reimbursement = Reimbursement::find($id);
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::table('karyawan')
            ->select('nama')
            ->union(DB::table('menyetujui')->select('nama'))
            ->union(DB::table('kasir')->select('nama'))
            ->orderBy('nama')
            ->get();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
        $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

        return view('halaman_admin.admin.reimbursement.edit_doc_RB', [
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

                        $rb_detail['bukti_reim'] = $fileName;
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
                $no_doku = $data->no_doku_draft;
                return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
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

                        $rb_detail['bukti_reim'] = $fileName;
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
                return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
            }
        }
    }

    public function edit_RB($id)
    {
        $title = 'Edit RB';
        $reimbursement = Reimbursement::find($id);
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = DB::table('karyawan')
            ->select('nama')
            ->union(DB::table('menyetujui')->select('nama'))
            ->union(DB::table('kasir')->select('nama'))
            ->orderBy('nama')
            ->get();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
        $originalDate = $reimbursement->tgl_diajukan;
        $formattedDate = date('d/m/Y', strtotime($originalDate));

        return view('halaman_admin.admin.reimbursement.edit_RB', [
            'title' => $title,
            'reimbursement' => $reimbursement,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'menyetujui' => $menyetujui,
            'rb_detail' => $rb_detail,
            'tgl_diajukan' => $formattedDate,
            'count' => count($rb_detail)
        ]);
    }
    public function update_RB(Request $request, $id)
    {
        if ($request->input('submitAction') == 'true') {
            try {
                $data = DB::table('admin_reimbursement')->where('id', $id)->first();
                $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
                $tgl_diajukan = $tanggal->format('Y-m-d');

                $reimbursement = [
                    'no_doku_real' => $request->no_doku,
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
                return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
            }
        }
    }
    // Fungsi untuk Edit TS
    public function edit_TS($id)
    {
        $title = 'Edit TS';
        $reimbursement = Reimbursement::find($id);
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = User::all();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        $originalDate = $reimbursement->tgl_diajukan;
        $formattedDate = date('d/m/Y', strtotime($originalDate));

        $ts_detail = DB::table('admin_timesheet_project_detail')->where('fk_timesheet_project', $id)->get();

        // dd($ts_detail);

        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');

        return view('halaman_admin.admin.reimbursement.TS.edit_TS', [
            'title' => $title,
            'reimbursement' => $reimbursement,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'menyetujui' => $menyetujui,
            'nominal_awal' => $nominal_awal,
            'ts_detail' => $ts_detail,
            'tgl_diajukan' => $formattedDate,
            'count' => count($ts_detail),
        ]);
    }

    public function update_TS(Request $request, $id)
    {
        if ($request->input('submitAction') == 'true') {
            try {
                $data = DB::table('admin_reimbursement')->where('id', $id)->first();
                $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
                $tgl_diajukan = $tanggal->format('Y-m-d');

                $reimbursement = [
                    'no_doku_real' => $request->no_doku,
                    'no_doku_draft' => null,
                    'tgl_diajukan' => $tgl_diajukan,
                    'judul_doku' => $request->judul_doku,
                    'pemohon' => $request->pemohon,
                    'accounting' => $request->accounting,
                    'kasir' => $request->kasir,
                    'menyetujui' => $request->nama_menyetujui,
                    'no_telp_direksi' => $request->no_telp,
                    'halaman' => 'TS',
                    'status_approved' => 'rejected',
                    'status_paid' => 'rejected'
                ];

                DB::table('admin_reimbursement')->where('id', $id)->update($reimbursement);

                foreach ($request->karyawan_ts as $deskripsi => $nama_karyawan) {
                    if ($request->flag[$deskripsi] == 'u') {
                        $idItem = $request->id[$deskripsi];
                        $ts_detail = Timesheet_Project_Detail::find($idItem);
                    } elseif ($request->flag[$deskripsi] == 'i') {
                        $ts_detail = new Timesheet_Project_Detail();
                    }
                    $ts_detail->nama_karyawan = $nama_karyawan;
                    $ts_detail->curr = $request->kurs[$deskripsi];
                    $ts_detail->nominal_awal = $request->nom_ts[$deskripsi];
                    $ts_detail->hari_awal = $request->hari[$deskripsi];
                    $ts_detail->hari = $request->hari_ts[$deskripsi];
                    if ($ts_detail->hari >= 19) {
                        $nominal = $ts_detail->nominal_awal;
                    } else {
                        $nominal = ($ts_detail->nominal_awal / $ts_detail->hari_awal) * $ts_detail->hari;
                    }
                    $ts_detail->nominal = $nominal;
                    $ts_detail->fk_timesheet_project = $id;

                    $ts_detail->save();
                }
                $no_doku = $data->no_doku_real;
                return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
    // Fungsi untuk Edit ST
    public function edit_ST($id)
    {
        $title = 'Edit TS';
        $reimbursement = Reimbursement::find($id);
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = User::all();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        $originalDate = $reimbursement->tgl_diajukan;
        $formattedDate = date('d/m/Y', strtotime($originalDate));

        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');

        $st_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();

        return view('halaman_admin.admin.reimbursement.ST.edit_ST', [
            'title' => $title,
            'reimbursement' => $reimbursement,
            'kurs' => $currency,
            'tgl_diajukan' => $formattedDate,
            'karyawan' => $karyawan,
            'menyetujui' => $menyetujui,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases,
            'st_detail' => $st_detail,
            'count' => count($st_detail)
        ]);
    }
    public function update_ST(Request $request, $id)
    {
        if ($request->input('submitAction') == 'true') {
            try {
                $data = DB::table('admin_reimbursement')->where('id', $id)->first();
                $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
                $tgl_diajukan = $tanggal->format('Y-m-d');

                $reimbursement = [
                    'no_doku_real' => $request->no_doku,
                    'no_doku_draft' => null,
                    'tgl_diajukan' => $tgl_diajukan,
                    'judul_doku' => $request->judul_doku,
                    'pemohon' => $request->pemohon,
                    'accounting' => $request->accounting,
                    'kasir' => $request->kasir,
                    'menyetujui' => $request->nama_menyetujui,
                    'no_telp_direksi' => $request->no_telp,
                    'halaman' => 'ST',
                    'status_approved' => 'rejected',
                    'status_paid' => 'rejected'
                ];

                DB::table('admin_reimbursement')->where('id', $id)->update($reimbursement);

                foreach ($request->karyawan_st as $deskripsi => $nama_karyawan) {
                    if ($request->flag[$deskripsi] == 'u') {
                        $idItem = $request->id[$deskripsi];
                        $st_detail = Support_Ticket_Detail::find($idItem);
                    } elseif ($request->flag[$deskripsi] == 'i') {
                        $st_detail = new Support_Ticket_Detail();
                    }
                    $st_detail->nama_karyawan = $nama_karyawan;
                    $st_detail->aliases = $request->aliases[$deskripsi];
                    $st_detail->curr = $request->kurs_st[$deskripsi];
                    $st_detail->nominal_awal = $request->nom_st[$deskripsi];
                    $st_detail->jam = $request->jam_st[$deskripsi];
                    $st_detail->fk_support_ticket = $id;

                    // dd($st_detail);

                    $st_detail->save();
                }
                $no_doku = $data->no_doku_real;
                return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
    // Fungsi untuk edit Support Lembur
    public function edit_SL($id)
    {
        $title = 'Edit SL';
        $reimbursement = Reimbursement::find($id);
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = User::all();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        $originalDate = $reimbursement->tgl_diajukan;
        $formattedDate = date('d/m/Y', strtotime($originalDate));

        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');

        $sl_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();

        return view('halaman_admin.admin.reimbursement.SL.edit_SL', [
            'title' => $title,
            'reimbursement' => $reimbursement,
            'kurs' => $currency,
            'tgl_diajukan' => $formattedDate,
            'karyawan' => $karyawan,
            'menyetujui' => $menyetujui,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases,
            'sl_detail' => $sl_detail,
            'count' => count($sl_detail)
        ]);
    }
    // Proses Edit Support Lembur
    public function update_SL(Request $request, $id)
    {
        if ($request->input('submitAction') == 'true') {
            try {
                $data = DB::table('admin_reimbursement')->where('id', $id)->first();
                $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
                $tgl_diajukan = $tanggal->format('Y-m-d');

                $reimbursement = [
                    'no_doku_real' => $request->no_doku,
                    'no_doku_draft' => null,
                    'tgl_diajukan' => $tgl_diajukan,
                    'judul_doku' => $request->judul_doku,
                    'pemohon' => $request->pemohon,
                    'accounting' => $request->accounting,
                    'kasir' => $request->kasir,
                    'menyetujui' => $request->nama_menyetujui,
                    'no_telp_direksi' => $request->no_telp,
                    'halaman' => 'SL',
                    'status_approved' => 'rejected',
                    'status_paid' => 'rejected'
                ];
                DB::table('admin_reimbursement')->where('id', $id)->update($reimbursement);

                foreach ($request->karyawan_sl as $deskripsi => $nama_karyawan) {
                    if ($request->flag[$deskripsi] == 'u') {
                        $idItem = $request->id[$deskripsi];
                        $sl_detail = Support_Lembur_Detail::find($idItem);
                    } elseif ($request->flag[$deskripsi] == 'i') {
                        $sl_detail = new Support_Lembur_Detail();
                    }
                    $sl_detail->nama_karyawan = $nama_karyawan;
                    $sl_detail->aliases = $request->aliases[$deskripsi];
                    $sl_detail->curr = $request->kurs_sl[$deskripsi];
                    $sl_detail->nominal_awal = $request->nom_sl[$deskripsi];
                    $sl_detail->jam = $request->jam_sl[$deskripsi];
                    $sl_detail->fk_support_lembur = $id;

                    $sl_detail->save();
                }
                $no_doku = $data->no_doku_real;
                return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diperbarui!');
            } catch (Exception $e) {
                return $e->getMessage();
            }
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
    public function tambah_reimbursement()
    {
        $title = 'Tambah RB';
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
        $currency = DB::select('SELECT * FROM kurs');
        $karyawan = User::all();
        $nominal_awal = DB::select('SELECT * FROM fee_timesheet');
        $nominal_project = DB::select('SELECT * FROM fee_project');
        $aliases = DB::select('SELECT * FROM client');
        // dd($no_dokumen);

        return view('halaman_admin.admin.reimbursement.tambah_reimbursement', [
            'title' => $title,
            'no_dokumen' => $no_dokumen,
            'accounting' => $accounting,
            'kasir' => $kasir,
            'menyetujui' => $menyetujui,
            'kurs' => $currency,
            'karyawan' => $karyawan,
            'nominal_awal' => $nominal_awal,
            'nominal_project' => $nominal_project,
            'aliases' => $aliases
        ]);
    }
    public function simpan_reimbursement(Request $request)
    {
        $tanggal = DateTime::createFromFormat('d/m/Y', $request->tgl_diajukan);
        $tgl_diajukan = $tanggal->format('Y-m-d');

        $reimbursement = new Reimbursement();
        $reimbursement->no_doku_real = $request->no_doku;
        $reimbursement->tgl_diajukan = $tgl_diajukan;
        $reimbursement->judul_doku = $request->judul_doku;
        $reimbursement->pemohon = $request->pemohon;
        $reimbursement->accounting = $request->accounting;
        $reimbursement->kasir = $request->kasir;
        $reimbursement->menyetujui = $request->nama_menyetujui;
        $reimbursement->no_telp_direksi = $request->no_telp;
        if ($request->project === 'RB (Reimbursement)') {
            $reimbursement->halaman = 'RB';
        } elseif ($request->project === 'TS (Timesheet Support)') {
            $reimbursement->halaman = 'TS';
        } elseif ($request->project === 'ST (Support Ticket)') {
            $reimbursement->halaman = 'ST';
        } elseif ($request->project === 'SL (Support Lembur)') {
            $reimbursement->halaman = 'SL';
        }
        $reimbursement->save();

        if ($request->project === 'RB (Reimbursement)') {

            foreach ($request->deskripsi as $deskripsi => $value) {
                $rb_detail = new Rb_Detail();
                $rb_detail->deskripsi = $value;

                if ($request->hasFile('foto') && $request->file('foto')[$deskripsi]->isValid()) {
                    $file = $request->file('foto')[$deskripsi];

                    // Menyimpan gambar asli tanpa kompresi
                    $filePath = 'bukti_RB_admin/' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('bukti_RB_admin'), $filePath);
                    $fileName = basename($filePath);

                    $rb_detail->bukti_rb = $fileName;
                }

                $rb_detail->no_bukti = $request->nobu[$deskripsi];
                $rb_detail->curr = $request->kurs_rb[$deskripsi];
                $rb_detail->nominal = $request->nom_rb[$deskripsi];
                $rb_detail->tanggal_1 = $request->tgl1[$deskripsi];
                $rb_detail->tanggal_2 = isset($request->tgl2[$deskripsi]) ? $request->tgl2[$deskripsi] : null;
                $rb_detail->keperluan = $request->keperluan[$deskripsi];
                $rb_detail->fk_rb = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'TS (Timesheet Support)') {
            foreach ($request->karyawan_ts as $index => $nama_karyawan) {
                $rb_detail = new Timesheet_Project_Detail();
                $rb_detail->nama_karyawan = $nama_karyawan;
                $rb_detail->curr = $request->kurs_ts[$index];
                $rb_detail->nominal_awal = $request->nom_ts[$index];
                $rb_detail->hari_awal = $request->hari_ts1[$index];
                $rb_detail->hari = $request->hari_ts2[$index];
                if ($rb_detail->hari >= 19) {
                    $nominal = $rb_detail->nominal_awal;
                } else {
                    $nominal = ($rb_detail->nominal_awal / $rb_detail->hari_awal) * $rb_detail->hari;
                }
                $rb_detail->nominal = $nominal;
                $rb_detail->fk_timesheet_project = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'ST (Support Ticket)') {
            foreach ($request->karyawan_st as $deskripsi => $nama_karyawan) {
                $rb_detail = new Support_Ticket_Detail();
                $rb_detail->nama_karyawan = $nama_karyawan;
                $rb_detail->aliases = $request->project_st[$deskripsi];
                $rb_detail->curr = $request->kurs_st[$deskripsi];
                $rb_detail->nominal_awal = $request->nom_st[$deskripsi];
                $rb_detail->jam = $request->jam_st[$deskripsi];
                $rb_detail->fk_support_ticket = $reimbursement->id;
                $rb_detail->save();
            }
        } elseif ($request->project === 'SL (Support Lembur)') {
            foreach ($request->karyawan_st as $deskripsi => $nama_karyawan) {
                $rb_detail = new Support_Lembur_Detail();
                $rb_detail->nama_karyawan = $nama_karyawan;
                $rb_detail->aliases = $request->project_st[$deskripsi];
                $rb_detail->curr = $request->kurs_st[$deskripsi];
                $rb_detail->nominal_awal = $request->nom_st[$deskripsi];
                $rb_detail->jam = $request->jam_st[$deskripsi];
                $rb_detail->fk_support_lembur = $reimbursement->id;
                $rb_detail->save();
            }
        }
        return redirect()->route('admin.reimbursement')->with('success', 'Data berhasil diajukan!');
    }
    public function excel_reimbursement($id)
    {
        return Excel::download(new ReimbursementExport($id), 'reimbursement_' . $id . '.xlsx');
    }
    public function setujui_reimbursement($id)
    {
        try {
            DB::table('admin_reimbursement')->where('id', $id)->update([
                'status_approved' => 'pending',
                'status_paid' => 'pending'
            ]);
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            $no_doku = $data->no_doku_real;
            return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil diajukan! Mohon Menunggu Persetujuan dari Direktur!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_reimbursement($id, Request $request)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            if ($data->halaman == 'RB') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'TS') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'ST') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'SL') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            }
            $no_doku = $data->no_doku;
            $alasan = $request->alasan;
            return redirect()->route('admin.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan Reimbursement yang berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
        }
    }
    public function lihat_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat RB';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');


            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
                'nominal' => $nominal,

            ]);
        } elseif ($reimbursement->halaman == 'TS') {
            $title = 'Lihat TS';
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
                $results_TS[] = round($result); // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'timesheet_project_detail' => $timesheet_project_detail,
                'results_TS' => $results_TS,
                'total_TS' => $total_TS,
            ]);
        } elseif ($reimbursement->halaman == 'ST') {
            $title = 'Lihat ST';
            $support_ticket_detail = DB::table('admin_support_ticket_detail')->where('fk_support_ticket', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_ticket_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_ticket_detail' => $support_ticket_detail,
                'results' => $results,
                'total' => $total
            ]);
        } elseif ($reimbursement->halaman == 'SL') {
            $title = 'Lihat SL';
            $support_lembur_detail = DB::table('admin_support_lembur_detail')->where('fk_support_lembur', $id)->get();
            $results = []; // Array untuk menyimpan hasil perhitungan masing-masing item

            foreach ($support_lembur_detail as $item) {
                $result = $item->nominal_awal * $item->jam;
                $results[] = $result; // Tambahkan hasil ke array
            }

            $total = array_sum($results);

            return view('halaman_admin.admin.reimbursement.lihat_reimbursement', [
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
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();
            $nominal = DB::table('admin_rb_detail')->where('fk_rb', $id)->sum('nominal');

            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
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
                $results_TS[] = round($result); // Tambahkan hasil ke array
            }
            $total_TS = array_sum($results_TS);
            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
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

            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
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

            $total_SL = array_sum($results);

            return view('halaman_admin.admin.reimbursement.print_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'support_lembur_detail' => $support_lembur_detail,
                'results' => $results,
                'total_ST' => $total_SL
            ]);
        }
    }
    public function print_bukti_reimbursement($id)
    {
        $reimbursement = Reimbursement::find($id);
        if ($reimbursement->halaman == 'RB') {
            $title = 'Lihat Bukti Reimbursement';
            $rb_detail = DB::table('admin_rb_detail')->where('fk_rb', $id)->get();

            return view('halaman_admin.admin.reimbursement.print_bukti_reimbursement', [
                'title' => $title,
                'reimbursement' => $reimbursement,
                'rb_detail' => $rb_detail,
            ]);
        }
    }
    public function kirim_WA($id)
    {
        $reimbursement = DB::table('admin_reimbursement')->find($id);

        $nomorTelepon = [
            $reimbursement->no_telp_direksi,
        ];

        // Membangun pesan yang diinginkan
        $pesan = "[Ini Adalah Pesan Dari Sistem]\nAda Permohonan RB No. " . $reimbursement->no_doku_real . " Dari " . $reimbursement->pemohon . " Menunggu Approval. \nKlik Disini untuk Melihat \nhttps://office.eclectic.co.id/";

        $urlWhatsApp = 'https://api.whatsapp.com/send';

        $berhasilDikirim = [];

        foreach ($nomorTelepon as $nomor) {
            try {
                $url = $urlWhatsApp . '?phone=' . $nomor . '&text=' . urlencode($pesan);
                $berhasilDikirim[] = $nomor;
            } catch (\Exception $e) {
                // Tangani kesalahan yang terjadi
                dd($e->getMessage());
            }
        }

        // Lakukan penanganan sesuai kebutuhan dengan menggunakan array berhasilDikirim
        if (!empty($berhasilDikirim)) {
            // Redirect ke halaman WhatsApp
            $redirectUrl = $urlWhatsApp . '?phone=' . implode(',', $berhasilDikirim) . '&text=' . urlencode($pesan);
            header("Location: " . $redirectUrl);
            exit();
            // dd($redirectUrl);
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pesan WhatsApp.');
        }
    }
    public function setujui_RB($id)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            if ($data->halaman == 'RB') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                ]);
            } elseif ($data->halaman == 'TS') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                ]);
            } elseif ($data->halaman == 'ST') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',

                ]);
            } elseif ($data->halaman == 'SL') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'approved',
                    'status_paid' => 'pending',
                ]);
            }
            $no_doku = $data->no_doku_real;
            return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
        }
    }
    public function tolak_RB($id, Request $request)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            if ($data->halaman == 'RB') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'TS') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'ST') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            } elseif ($data->halaman == 'SL') {
                DB::table('admin_reimbursement')->where('id', $id)->update([
                    'status_approved' => 'rejected',
                    'status_paid' => 'pending',
                    'alasan' => $request->alasan
                ]);
            }
            $no_doku = $data->no_doku_real;
            $alasan = $request->alasan;
            return redirect()->route('admin.beranda')->with('error', 'Data dengan no dokumen ' . $no_doku . ' tidak disetujui karena ' . $alasan . ' Mohon Ajukan Reimbursement yang berbeda!');
        } catch (\Exception $e) {
            return redirect()->route('admin.reimbursement')->with('gagal', $e->getMessage());
        }
    }
    public function delete_RB($id)
    {
        try {
            $data = DB::table('admin_reimbursement')->where('id', $id)->first();
            if ($data->status_approved == 'hold' && $data->status_paid == 'hold') {
                $RB = Reimbursement::findOrFail($id);
                // dd($RB);
                if ($RB) {
                    $RB_detail = Rb_Detail::where('fk_rb', $id);
                    $RB->delete();
                    $RB_detail->delete();
                }
                $halaman = $data->halaman;
                // dd($no_doku);
                return redirect()->route('admin.reimbursement')->with('success', 'Data ' . $halaman . ' berhasil dihapus!');
            } elseif ($data->status_approved == 'rejected' && $data->status_paid == 'rejected') {
                // dd($data->halaman);
                if ($data->halaman == 'RB') {
                    $RB = Reimbursement::findOrFail($id);
                    if ($RB) {
                        $RB_detail = Rb_Detail::where('fk_rb', $id);
                        $RB->delete();
                        $RB_detail->delete();
                    }
                    $no_doku = $data->no_doku_real;
                    return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dihapus!');
                } elseif ($data->halaman == 'ST') {
                    $RB = Reimbursement::findOrFail($id);
                    if ($RB) {
                        $ST_detail = Support_Ticket_Detail::where('fk_support_ticket', $id);
                        $RB->delete();
                        $ST_detail->delete();
                    }
                    $no_doku = $data->no_doku_real;
                    return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dihapus!');
                } elseif ($data->halaman == 'SL') {
                    $RB = Reimbursement::findOrFail($id);
                    if ($RB) {
                        $ST_detail = Support_Lembur_Detail::where('fk_support_lembur', $id);
                        $RB->delete();
                        $ST_detail->delete();
                    }
                    $no_doku = $data->no_doku_real;
                    return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dihapus!');
                } elseif ($data->halaman == 'TS') {
                    $RB = Reimbursement::findOrFail($id);
                    if ($RB) {
                        $ST_detail = Timesheet_Project_Detail::where('fk_timesheet_project', $id);
                        $RB->delete();
                        $ST_detail->delete();
                    }
                    $no_doku = $data->no_doku_real;
                    return redirect()->route('admin.reimbursement')->with('success', 'Data dengan no dokumen ' . $no_doku . ' berhasil dihapus!');
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
