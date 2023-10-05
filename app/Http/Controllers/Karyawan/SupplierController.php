<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $title = 'Supplier';
        $pemohon = Auth::user()->nama;
        $supplier = DB::table('supplier')->where('PIC', $pemohon)
            ->orderBy('nama_supplier', 'asc')
            ->paginate(20);
        return view('halaman_karyawan.karyawan.supplier.index', [
            'title' => $title,
            'supplier' => $supplier
        ]);
    }
    public function add_supplier()
    {
        $title = 'Tambah Supplier';
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        return view('halaman_karyawan.karyawan.supplier.add_supplier', [
            'title' => $title,
            'menyetujui' => $menyetujui
        ]);
    }
    public function save_supplier(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:supplier,nama_supplier'
        ], [
            'nama.*' => 'Nama Supplier tidak boleh digunakan kedua kali!'
        ]);
        DB::table('supplier')->insert([
            'nama_supplier' => $request->nama,
            'PIC' => $request->pic,
            'menyetujui' => $request->nama_menyetujui,
            'no_rekening' => $request->no_rek,
            'bank' => $request->bank,
            'pemilik_bank' => $request->pemilik_bank,
        ]);

        return redirect()->route('karyawan.supplier')->with('success', 'Data Supplier Berhasil Ditambahkan!');
    }
    public function delete_supplier($id)
    {
        DB::table('supplier')->where('id', $id)->delete();
        return redirect()->route('karyawan.supplier')->with('success', 'Data Supplier Berhasil Dihapus!');
    }
    public function edit_supplier($id)
    {
        $title = 'Edit Supplier';
        $dataSupplierEdit = DB::table('supplier')->where('id', $id)->first();
        $menyetujui = User::join('role_has_user', 'user.id', '=', 'role_has_user.fk_user')
            ->where('fk_role', 4)
            ->orderBy('nama', 'asc')
            ->get();
        return view('halaman_karyawan.karyawan.supplier.edit_supplier', [
            'title' => $title,
            'menyetujui' => $menyetujui,
            'supplier' => $dataSupplierEdit
        ]);
    }
    public function update_supplier(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:supplier,nama_supplier'
        ], [
            'nama.*' => 'Nama Supplier tidak boleh digunakan kedua kali!'
        ]);
        DB::table('supplier')->where('id', $id)->update([
            'nama_supplier' => $request->nama,
            'PIC' => $request->pic,
            'menyetujui' => $request->nama_menyetujui,
            'no_rekening' => $request->no_rek,
            'bank' => $request->bank,
            'pemilik_bank' => $request->pemilik_bank,
        ]);
        return redirect()->route('karyawan.supplier')->with('success', 'Data Supplier berhasil diperbarui!');
    }
}
