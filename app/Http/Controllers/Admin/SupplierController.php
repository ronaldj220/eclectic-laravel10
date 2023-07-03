<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menyetujui;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $title = 'Master Supplier';
        $dataSupplier = DB::table('supplier')->paginate(10);
        return view('halaman_admin.supplier.index', [
            'title' => $title,
            'supplier' => $dataSupplier
        ]);
    }
    public function tambah_supplier()
    {
        $title = 'Tambah Supplier';
        $menyetujui = Menyetujui::all();
        return view('halaman_admin.supplier.tambah_supplier', [
            'title' => $title,
            'menyetujui' => $menyetujui
        ]);
    }
    public function simpan_supplier(Request $request)
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
        return redirect()->route('admin.supplier')->with('success', 'Data Supplier Berhasil Ditambahkan!');
    }
    public function edit_supplier($id)
    {
        $dataSupplierEdit = DB::table('supplier')->where('id', $id)->first();
        $menyetujui = Menyetujui::all();
        $title = 'Edit Supplier';
        return view('halaman_admin.supplier.edit_supplier', [
            'title' => $title,
            'menyetujui' => $menyetujui,
            'supplier' => $dataSupplierEdit
        ]);
    }
    public function update_supplier(Request $request, $id)
    {
        DB::table('supplier')->where('id', $id)->update([
            'nama_supplier' => $request->nama,
            'PIC' => $request->pic,
            'menyetujui' => $request->nama_menyetujui,
            'no_rekening' => $request->no_rek,
            'bank' => $request->bank,
            'pemilik_bank' => $request->pemilik_bank,
        ]);
        return redirect()->route('admin.supplier')->with('success', 'Data Supplier Berhasil Diperbarui!');
    }
    public function hapus_supplier($id)
    {
        DB::table('supplier')->where('id', $id)->delete();
        return redirect()->route('admin.supplier')->with('success', 'Data Supplier Berhasil Dihapus!');
    }
}
