<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fee_ProjectController extends Controller
{
    public function index()
    {
        $title = 'Biaya Project';
        $dataFeeProject = DB::table('fee_project')->paginate(10);
        return view('halaman_admin.fee_project.index', [
            'title' => $title,
            'FeeProject' => $dataFeeProject
        ]);
    }
    public function tambah_fee_project()
    {
        $title = 'Tambah Biaya Project';
        return view('halaman_admin.fee_project.tambah_fee_project', [
            'title' => $title
        ]);
    }
    public function simpan_fee_project(Request $request)
    {
        DB::table('fee_project')->insert([
            'nominal' => $request->nominal
        ]);
        return redirect()->route('admin.master_fee_project')->with('success', 'Data Biaya Project Berhasil Ditambahkan!');
    }
    public function edit_fee_project($id)
    {
        $dataFeeProjectEdit = DB::table('fee_project')->where('id', $id)->first();
        $title = 'Edit Biaya Project';
        return view('halaman_admin.fee_project.edit_fee_project', [
            'title' => $title,
            'project' => $dataFeeProjectEdit
        ]);
    }
    public function update_fee_project(Request $request, $id)
    {
        DB::table('fee_project')->where('id', $id)->update([
            'nominal' => $request->nominal
        ]);
        return redirect()->route('admin.master_fee_project')->with('success', 'Data Biaya Project Berhasil Diperbarui!');
    }
    public function hapus_fee_project($id)
    {
        DB::table('fee_project')->where('id', $id)->delete();
        return redirect()->route('admin.master_fee_project')->with('success', 'Data Biaya Project Berhasil Dihapus!');
    }
}
