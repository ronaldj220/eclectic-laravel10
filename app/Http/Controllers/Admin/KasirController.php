<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kasir;
use App\Models\Role_Has_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    public function index()
    {
        $title = 'Kasir';
        $dataKasir = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 3)
            ->get();
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
            'email' => 'required|unique:user,email'
        ], [
            'email.*' => 'Email tidak boleh digunakan kedua kali!'
        ]);

        $userNew = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'jabatan' => 'Finance'
        ]);

        Role_Has_User::create([
            'fk_user' => $userNew->id,
            'fk_role' => 3
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
