<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function index()
    {
        $title = 'Mata Uang';
        $dataCurrency = Kurs::paginate(10);
        return view('halaman_admin.currency.index', [
            'title' => $title,
            'kurs' => $dataCurrency
        ]);
    }
    public function tambah_currency()
    {
        $title = 'Tambah Mata Uang';
        return view('halaman_admin.currency.tambah_currency', [
            'title' => $title
        ]);
    }
    public function simpan_currency(Request $request)
    {
        $request->validate([
            'kurs' => 'required|unique:kurs,mata_uang'
        ], [
            'kurs.*' => 'Mata Uang tidak boleh digunakan kedua kali!'
        ]);
        Kurs::create([
            'mata_uang' => $request->kurs
        ]);
        return redirect()->route('admin.currency')->with('success', 'Data Currency Berhasil Ditambahkan!');
    }
    public function edit_currency($id)
    {
        $dataCurrencyEdit = DB::table('kurs')->where('id', $id)->first();
        $title = 'Edit Mata Uang';
        return view('halaman_admin.currency.edit_currency', [
            'title' => $title,
            'kurs' => $dataCurrencyEdit
        ]);
    }
    public function update_currency(Request $request, $id)
    {
        DB::table('kurs')->where('id', $id)->update([
            'mata_uang' => $request->kurs
        ]);
        return redirect()->route('admin.currency')->with('success', 'Data Currency Berhasil Diperbarui!');
    }
    public function hapus_currency($id)
    {
        $dataCurrencyHapus = Kurs::findOrFail($id);
        $dataCurrencyHapus->delete();
        return redirect()->route('admin.currency')->with('success', 'Data Currency Berhasil Dihapus!');
    }
}
