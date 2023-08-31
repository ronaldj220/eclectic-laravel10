<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Karyawan';
        if ($request->has('search')) {
            $dataKaryawan = User::whereIn('jabatan', ['Konsultan', 'Project Manager', 'Staff', 'Support Manager'])
                ->where('nama', 'LIKE', '%' . $request->search . '%')
                ->orderBy('nama', 'asc')
                ->paginate(20);
        } else {
            $dataKaryawan = User::whereIn('jabatan', ['Konsultan', 'Project Manager', 'Staff', 'Support Manager'])
                ->orderBy('nama', 'asc')
                ->paginate(20);
        }
        return view('halaman_admin.karyawan.index', [
            'title' => $title,
            'dataKaryawan' => $dataKaryawan
        ]);
    }
    public function tambah_karyawan()
    {
        $title = 'Tambah Karyawan';
        return view('halaman_admin.karyawan.tambah_karyawan', [
            'title' => $title
        ]);
    }
    public function simpan_karyawan(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:user,email',
            'signature' => 'required|unique:user,ttd'
        ], [
            'email.unique' => 'Email tidak boleh digunakan kedua kali!',
            'email.required' => 'Email tidak boleh kosong',
            'signature.required' => 'Tanda Tangan tidak boleh kosong'
        ]);

        $image_parts = explode(";base64,", $request->input('signature'));
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = 'TTD_' . date('YmdHis') . '.' . $image_type;

        $filePath = 'signatures/' . $filename;
        $fullFilePath = public_path($filePath);
        // dd($filename);
        // Simpan file dalam direktori public
        file_put_contents($fullFilePath, $image_base64);
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'no_rekening' => $request->no_rekening,
            'no_telp' => $request->no_telp,
            'bank' => $request->bank,
            'ttd' => $filename
        ];
        User::create($data);
        return redirect()->route('admin.karyawan')->with('success', 'Data Karyawan Berhasil Ditambahkan!');
    }
    public function edit_karyawan($id)
    {
        $dataKaryawanEdit = DB::table('karyawan')->where('id', $id)->first();
        $title = 'Edit Karyawan';
        return view('halaman_admin.karyawan.edit_karyawan', [
            'title' => $title,
            'karyawan' => $dataKaryawanEdit
        ]);
    }
    public function update_karyawan(Request $request, $id)
    {
        DB::table('karyawan')->where('id', $id)->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('admin.karyawan')->with('success', 'Data Karyawan Berhasil Diperbarui!');
    }
    public function hapus_karyawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('admin.karyawan')->with('success', 'Data Karyawan Berhasil Dihapus!');
    }
}
