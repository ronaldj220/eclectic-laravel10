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
        $dataAdmin = DB::table('user')->join('role_has_user', 'user.id', '=', 'role_has_user.fk_role')
            ->where('fk_role', 1)
            ->paginate(10);

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
            'email' => 'required|unique:user,email',
        ], [
            'email.unique' => 'Email tidak boleh digunakan kedua kali!',
            'email.required' => 'Email tidak boleh kosong',
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
        ];
        User::create($data);
        // dd($data);
        return redirect()->route('admin.admin')->with('success', 'Data Admin Berhasil Ditambahkan!');
    }
    public function edit_admin($id)
    {
        $dataAdminEdit = User::find($id);
        $title = 'Edit Admin';
        return view('halaman_admin.admin.edit_admin', [
            'title' => $title,
            'admin' => $dataAdminEdit
        ]);
    }
    public function update_admin(Request $request, $id)
    {
        // Validasi input sesuai kebutuhan
        $request->validate([
            'email' => 'required|email|unique:user,email,' . $id,
        ]);
        // Buat array data untuk diupdate
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'no_telp' => $request->no_telp,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank,
        ];

        // Jika ada tanda tangan baru, tambahkan data tanda tangan ke array

        User::where('id', $id)->update($data);

        return redirect()->route('admin.admin')->with('success', 'Data Admin Berhasil Diperbarui!');
    }
    public function hapus_admin($id)
    {
        $hapusdataadmin = User::findOrFail($id);
        $hapusdataadmin->delete();
        return redirect()->route('admin.admin')->with('success', 'Data Admin Berhasil Dihapus!');
    }
}
