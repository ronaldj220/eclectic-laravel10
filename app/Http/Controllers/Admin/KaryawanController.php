<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $title = 'Karyawan';
        $dataKaryawan = DB::table('karyawan')->paginate(10);
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
            'email' => 'required|unique:karyawan,email'
        ], [
            'email.*' => 'Email tidak boleh digunakan kedua kali!'
        ]);

        DB::table('karyawan')->insert([
            'email' => $request->email,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request->password)
        ]);
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
