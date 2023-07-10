<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menyetujui;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MenyetujuiController extends Controller
{
    public function index()
    {
        $title = 'Direktur';
        $dataMenyetujui = DB::table('menyetujui')->paginate(10);
        return view('halaman_admin.menyetujui.index', [
            'title' => $title,
            'direktur' => $dataMenyetujui
        ]);
    }
    public function tambah_menyetujui()
    {
        $title = 'Tambah Menyetujui (Halaman Direktur)';
        return view('halaman_admin.menyetujui.tambah_menyetujui', [
            'title' => $title
        ]);
    }
    public function simpan_menyetujui(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:menyetujui,email'
        ], [
            'email.*' => 'Email tidak boleh digunakan kedua kali!'
        ]);

        DB::table('menyetujui')->insert([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'no_telp' => $request->no_telp
        ]);
        return redirect()->route('admin.menyetujui')->with('success', 'Data Menyetujui Berhasil Ditambahkan!');
    }
    public function edit_menyetujui($id)
    {
        $dataMenyetujuiEdit = DB::table('menyetujui')->where('id', $id)->first();
        $title = 'Edit Direktur (Menyetujui)';
        return view('halaman_admin.menyetujui.edit_menyetujui', [
            'title' => $title,
            'menyetujui' => $dataMenyetujuiEdit
        ]);
    }
    public function update_menyetujui(Request $request, $id)
    {
        DB::table('menyetujui')->where('id', $id)->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan
        ]);
        return redirect()->route('admin.menyetujui')->with('success', 'Data Menyetujui Berhasil Diubah!');
    }
    public function hapus_menyetujui($id)
    {
        $dataMenyetujuiHapus = Menyetujui::findorFail($id);
        $dataMenyetujuiHapus->delete();
        return redirect()->route('admin.menyetujui')->with('success', 'Data Menyetujui Berhasil Dihapus!');
    }
}
