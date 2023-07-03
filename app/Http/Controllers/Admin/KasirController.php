<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    public function index()
    {
        $title = 'Kasir';
        $dataKasir = DB::table('kasir')->paginate(10);
        return view('halaman_admin.kasir.index', [
            'title' => $title,
            'kasir' => $dataKasir
        ]);
    }
    public function tambah_kasir()
    {
        $title = 'Tambah Kasir';
        return view('halaman_admin.kasir.tambah_kasir', [
            'title' => $title
        ]);
    }
    public function simpan_kasir(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:kasir,email'
        ], [
            'email.*' => 'Email tidak boleh digunakan kedua kali!'
        ]);

        DB::table('kasir')->insert([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('admin.kasir')->with('success', 'Data Kasir Berhasil Ditambahkan!');
    }
    public function edit_kasir($id)
    {
        $dataKasirEdit = DB::table('kasir')->where('id', $id)->first();
        $title = 'Edit Kasir';
        return view('halaman_admin.kasir.edit_kasir', [
            'title' => $title,
            'kasir' => $dataKasirEdit
        ]);
    }
    public function update_kasir(Request $request, $id)
    {
        DB::table('kasir')->where('id', $id)->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('admin.kasir')->with('success', 'Data Kasir Berhasil Diperbarui!');
    }
    public function hapus_kasir($id)
    {
        $dataKasirHapus = Kasir::findOrFail($id);
        $dataKasirHapus->delete();
        return redirect()->route('admin.kasir')->with('success', 'Data Kasir Berhasil Dihapus!');
    }
}
