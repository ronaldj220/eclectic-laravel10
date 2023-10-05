<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Role_Has_User;
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
            $dataKaryawan = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
                ->where('role_has_user.fk_role', 2)
                ->where('user.nama', 'LIKE', $request->search . '%')
                ->orderBy('user.nama', 'asc')
                ->paginate(10);
        } else {
            $dataKaryawan = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
                ->where('role_has_user.fk_role', 2)
                ->orderBy('nama', 'asc')
                ->paginate(10);
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
        ], [
            'email.unique' => 'Email tidak boleh digunakan kedua kali!',
            'email.required' => 'Email tidak boleh kosong',
        ]);

        // dd($request->all());
        $image_parts = explode(";base64,", $request->input('signature'));
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = 'TTD_' . date('YmdHis') . '.' . $image_type;

        $filePath = 'signatures/' . $filename;
        $fullFilePath = public_path($filePath);
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
        ];
        if ($filename) {
            $data['ttd'] = $filename;
        } else {
            $data['ttd'] = null;
        }
        $userNew = User::create($data);
        Role_Has_User::create([
            'fk_user' => $userNew->id,
            'fk_role' => 2
        ]);
        return redirect()->route('admin.karyawan')->with('success', 'Data Karyawan Berhasil Ditambahkan!');
    }
    public function edit_karyawan($id)
    {
        $dataKaryawanEdit = User::find($id);
        // dd($dataKaryawanEdit);
        $title = 'Edit Karyawan';
        return view('halaman_admin.karyawan.edit_karyawan', [
            'title' => $title,
            'karyawan' => $dataKaryawanEdit
        ]);
    }
    public function update_karyawan(Request $request, $id)
    {
        // $image_parts = explode(";base64,", $request->input('signature'));
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);
        // $filename = 'TTD_' . date('YmdHis') . '.' . $image_type;

        // $filePath = 'signatures/' . $filename;
        // $fullFilePath = public_path($filePath);
        // // Simpan file dalam direktori public
        // file_put_contents($fullFilePath, $image_base64);
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'no_rekening' => $request->no_rekening,
            'no_telp' => $request->no_telp,
            'bank' => $request->bank,
        ];
        // if ($filename) {
        //     $data['ttd'] = $filename;
        // } else {
        //     $data['ttd'] = null;
        // }

        $updatedKaryawan = User::find($id);
        if ($updatedKaryawan) {
            $updatedKaryawan->update($data);
            return redirect()->route('admin.karyawan')->with('success', 'Data Karyawan Berhasil Diperbarui!');
        } else {
            return redirect()->route('admin.karyawan')->with('gagal', 'Data Karyawan Gagal Diperbarui!');
        }
    }
    public function hapus_karyawan($id)
    {
        $karyawan = User::findorFail($id);
        if ($karyawan) {
            $role_has_user = Role_Has_User::where('fk_user', $id);
            $role_has_user->delete();
            $karyawan->delete();
            return redirect()->route('admin.karyawan')->with('success', 'Data Karyawan Berhasil Dihapus!');
        } else {
            return redirect()->route('admin.karyawan')->with('gagal', 'Data Karyawan Gagal Diperbarui!');
        }
    }
}
