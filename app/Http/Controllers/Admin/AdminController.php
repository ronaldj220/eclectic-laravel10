<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Admin';
        $dataAdmin = DB::table('users')->paginate(10);
        return view('halaman_admin.admin.index', [
            'title' => $title,
            'admin' => $dataAdmin
        ]);
    }
    public function tambah_admin()
    {
        $title = 'Tambah Admin';
        return view('halaman_admin.admin.tambah_admin', [
            'title' => $title
        ]);
    }
    public function simpan_admin(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email'
        ], [
            'email.*' => 'Email tidak boleh digunakan kedua kali!'
        ]);

        DB::table('users')->insert([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank
        ]);
        return redirect()->route('admin.admin')->with('success', 'Data Admin Berhasil Ditambahkan!');
    }
    public function edit_admin($id)
    {
        $dataAdminEdit = DB::table('users')->where('id', $id)->first();
        $title = 'Edit Admin';
        return view('halaman_admin.admin.edit_admin', [
            'title' => $title,
            'admin' => $dataAdminEdit
        ]);
    }
    public function update_admin(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank
        ]);
        return redirect()->route('admin.admin')->with('success', 'Data Admin Berhasil Diperbarui!');
    }
    public function hapus_admin($id)
    {
        $hapusdataadmin = User::findOrFail($id);
        $hapusdataadmin->delete();
        return redirect()->route('admin.admin')->with('success', 'Data Admin Berhasil Dihapus!');
    }
}
