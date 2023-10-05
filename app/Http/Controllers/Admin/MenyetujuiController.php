<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menyetujui;
use App\Models\Role_Has_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MenyetujuiController extends Controller
{
    public function index()
    {
        $title = 'Direktur';
        $dataMenyetujui = DB::table('user')->join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->paginate(10);
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
            'email' => 'required|unique:user,email',
        ], [
            'email.unique' => 'Email tidak boleh digunakan kedua kali!',
            'email.required' => 'Email tidak boleh kosong',
        ]);
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
        $userNew = User::create($data);
        Role_Has_User::create([
            'fk_user' => $userNew->id,
            'fk_role' => 4
        ]);
        return redirect()->route('admin.menyetujui')->with('success', 'Data Menyetujui Berhasil Ditambahkan!');
    }
    public function edit_menyetujui($id)
    {
        $dataMenyetujuiEdit = User::find($id);
        $title = 'Edit Direktur (Menyetujui)';
        return view('halaman_admin.menyetujui.edit_menyetujui', [
            'title' => $title,
            'menyetujui' => $dataMenyetujuiEdit
        ]);
    }
    public function update_menyetujui(Request $request, $id)
    {
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ];
        $updatedKaryawan = User::find($id);
        if ($updatedKaryawan) {
            $updatedKaryawan->update($data);
            // return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Diupdate!');
            return redirect()->route('admin.menyetujui')->with('success', 'Data Menyetujui Berhasil Diubah!');
        } else {
            return redirect()->route('admin.menyetujui')->with('gagal', 'Data Menyetujui Gagal Diperbarui!');
        }
    }
    public function hapus_menyetujui($id)
    {
        $karyawan = User::findorFail($id);
        if ($karyawan) {
            $role_has_user = Role_Has_User::where('fk_user', $id);
            $role_has_user->delete();
            $karyawan->delete();
            return redirect()->route('admin.menyetujui')->with('success', 'Data Menyetujui Berhasil Dihapus!');
        } else {
            return redirect()->route('admin.menyetujui')->with('gagal', 'Data Menyetujui Gagal Diperbarui!');
        }
    }
}
