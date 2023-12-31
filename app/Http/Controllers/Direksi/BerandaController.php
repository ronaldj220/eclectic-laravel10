<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BerandaController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        $menyetujui = Auth::user()->nama;
        $statusWaiting = 'pending';

        $reimbursementQuery = DB::table('admin_reimbursement')
            ->select('id', 'no_doku_real', 'pemohon', DB::raw("'reimbursement' as source"))
            ->whereIn('status_approved', [$statusWaiting])
            ->whereIn('status_paid', [$statusWaiting])
            ->where('menyetujui', $menyetujui);

        $cashAdvanceQuery = DB::table('admin_cash_advance')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance' as source"))
            ->whereIn('status_approved', [$statusWaiting])
            ->whereIn('status_paid', [$statusWaiting])
            ->where('menyetujui', $menyetujui);

        $cashAdvanceReportQuery = DB::table('admin_cash_advance_report')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance_report' as source"))
            ->whereIn('status_approved', [$statusWaiting])
            ->whereIn('status_paid', [$statusWaiting])
            ->where('menyetujui', $menyetujui);

        $purchaseRequestQuery = DB::table('admin_purchase_request')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'cash_advance_report' as source"))
            ->whereIn('status_approved', [$statusWaiting])
            ->whereIn('status_paid', [$statusWaiting])
            ->where('menyetujui', $menyetujui);


        $purchaseOrderQuery = DB::table('admin_purchase_order')
            ->select('id', 'no_doku', 'pemohon', DB::raw("'purchase_order' as source"))
            ->whereIn('status_approved', [$statusWaiting])
            ->whereIn('status_paid', [$statusWaiting])
            ->where('menyetujui', $menyetujui);

        $combinedData = $reimbursementQuery
            ->union($cashAdvanceQuery)
            ->union($cashAdvanceReportQuery)
            ->union($purchaseRequestQuery)
            ->union($purchaseOrderQuery)
            ->orderBy('no_doku_real', 'desc')
            ->get();

        $perPage = 10; // Jumlah item per halaman
        $currentPage = request()->get('page', 1); // Ambil nomor halaman dari query string

        // Hitung jumlah total data
        $totalDataCount = $combinedData->count();

        // Ambil data untuk halaman saat ini
        $currentPageData = $combinedData->forPage($currentPage, $perPage);

        // Buat manual pagination
        $pagination = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageData,
            $totalDataCount,
            $perPage,
            $currentPage,
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), // Untuk mengambil path URL yang benar
                'query' => request()->query(), // Untuk mempertahankan query string saat pindah halaman
            ]
        );

        return view('halaman_direksi.direksi.index', [
            'title' => $title,
            'combinedData' => $pagination,
        ]);
    }
    public function profile()
    {
        $title = 'Profil Direksi';
        return view('halaman_direksi.direksi.profile', [
            'title' => $title
        ]);
    }
    public function update_profile(Request $request, $id)
    {
        if ($request->input('signature')) {
            $image_parts = explode(";base64,", $request->input('signature'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = 'TTD_' . date('YmdHis') . '.' . $image_type;

            $filePath = 'signatures/' . $filename;
            $fullFilePath = public_path($filePath);
            file_put_contents($fullFilePath, $image_base64);
            $data['ttd'] = $filename;
        } else {
            $data['ttd'] = null;
        }
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'no_rekening' => $request->no_rekening,
            'no_telp' => $request->no_telp,
            'bank' => $request->bank,
        ];
        $updatedKaryawan = User::find($id);
        if ($updatedKaryawan) {
            $updatedKaryawan->update($data);
            return redirect()->route('direksi.beranda')->with('success', 'Profil Direksi Berhasil Diperbarui!');
        } else {
            return redirect()->route('direksi.beranda')->with('gagal', 'Profil Direksi Gagal Diperbarui!');
        }
    }
}
