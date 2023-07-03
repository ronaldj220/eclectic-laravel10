<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function index()
    {
        $title = 'Accounting';
        $dataAccounting = DB::table('accounting')->paginate(10);
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
        $request->validate([
            'nama_accounting' => 'required|unique:accounting,nama'
        ]);
        DB::table('accounting')->insert([
            'nama' => $request->nama_accounting
        ]);
        return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Disimpan!');
    }
    public function edit_accounting($id)
    {
        $dataAccountingEdit = DB::table('accounting')->where('id', $id)->first();
        $title = 'Edit Accounting';

        return view('halaman_admin.accounting.edit_accounting', [
            'title' => $title,
            'accounting' => $dataAccountingEdit
        ]);
    }
    public function update_accounting(Request $request)
    {
        DB::table('accounting')->update([
            'nama' => $request->nama_accounting
        ]);
        return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Diupdate!');
    }
    public function hapus_accounting($id)
    {
        $dataAccountingHapus = Accounting::findOrFail($id);
        $dataAccountingHapus->delete();
        return redirect()->route('admin.accounting')->with('success', 'Data Accounting Berhasil Dihapus!');
    }
}
