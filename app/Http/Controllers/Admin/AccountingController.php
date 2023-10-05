<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Role_Has_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountingController extends Controller
{
    public function index()
    {
        $title = 'Accounting';
        $dataAccounting = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 2)
            ->get();;
        return view('halaman_admin.accounting.index', [
            'title' => $title,
            'accounting' => $dataAccounting
        ]);
    }
    public function tambah_accounting()
    {
        $title = 'Tambah Accounting';
        return view('halaman_admin.accounting.tambah_accounting', [
            'title' => $title
        ]);
    }
    public function simpan_accounting(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_accounting' => 'required|unique:user,nama'
        ]);
        $data = [
            'email' => $request->email,
            'nama' => $request->nama_accounting,
            'password' => Hash::make($request->password),
            'jabatan' => 'Accounting',
        ];
        $userNew = User::create($data);
        Role_Has_User::create([
            'fk_user' => $userNew->id,
            'fk_role' => 2
        ]);
        return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Disimpan!');
    }
    public function edit_accounting($id)
    {
        $dataAccountingEdit = User::find($id);
        $title = 'Edit Accounting';

        return view('halaman_admin.accounting.edit_accounting', [
            'title' => $title,
            'accounting' => $dataAccountingEdit
        ]);
    }
    public function update_accounting(Request $request, $id)
    {
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'jabatan' => 'Accounting',
        ];
        $updatedKaryawan = User::find($id);
        if ($updatedKaryawan) {
            $updatedKaryawan->update($data);
            return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Diupdate!');
        } else {
            return redirect()->route('admin.accounting')->with('gagal', 'Data Accounting Gagal Diperbarui!');
        }
    }
    public function hapus_accounting($id)
    {
        $dataAccountingHapus = Accounting::findOrFail($id);
        $dataAccountingHapus->delete();
        return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Dihapus!');
    }
}
