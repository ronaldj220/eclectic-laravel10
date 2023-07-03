<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $title = 'Master Project/Client';
        $dataClient = DB::table('client')->paginate(10);
        return view('halaman_admin.clients.index', [
            'title' => $title,
            'client' => $dataClient
        ]);
    }
    public function tambah_client()
    {
        $title = 'Tambah Project/Client';
        return view('halaman_admin.clients.tambah_client', [
            'title' => $title
        ]);
    }
    public function simpan_client(Request $request)
    {


        DB::table('client')->insert([
            'kode_project' => isset($request->kode) ? $request->kode : null,
            'nama_perusahaan' => $request->nama,
            'aliases' => $request->nickname,
            'group' => isset($request->group) ? $request->group : null
        ]);
        return redirect()->route('admin.client')->with('success', 'Data Client/Project Berhasil Ditambahkan!');
    }
    public function edit_client($id)
    {
        $dataClientEdit = DB::table('client')->where('id', $id)->first();
        $title = 'Edit Project/Client';
        return view('halaman_admin.clients.edit_client', [
            'title' => $title,
            'client' => $dataClientEdit
        ]);
    }
    public function update_client(Request $request, $id)
    {
        DB::table('client')->where('id', $id)->update([
            'kode_project' => $request->kode,
            'nama_perusahaan' => $request->nama,
            'aliases' => $request->nickname,
            'group' => isset($request->group) ? $request->group : null
        ]);
        return redirect()->route('admin.client')->with('success', 'Data Client/Project Berhasil Diperbarui!');
    }
    public function hapus_client($id)
    {
        DB::table('client')->where('id', $id)->delete();
        return redirect()->route('admin.client')->with('success', 'Data Client/Project Berhasil Dihapus!');
    }
}
