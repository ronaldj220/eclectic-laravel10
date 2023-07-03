<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterPOController extends Controller
{
    public function index()
    {
        $title = 'Master PO';
        $dataPO = DB::table('master_po')->paginate(2);
        return view('halaman_admin.master_PO.index', [
            'title' => $title,
            'PO' => $dataPO
        ]);
    }
    public function edit_PO($id)
    {
        $title = 'Edit Master PO';
        $dataPO = DB::table('master_po')->where('id', $id)->first();
        return view(
            'halaman_admin.master_PO.edit_master_PO',
            [
                'title' => $title,
                'PO' => $dataPO
            ]
        );
    }
    public function update_PO($id, Request $request)
    {
        DB::table('master_po')->where('id', $id)->update([
            'VAT' => $request->VAT,
            'PPH' => $request->PPH,
            'PPH_4' => $request->PPH_4
        ]);
        return redirect()->route('admin.master_PO')->with('success', 'Data Perhitungan PO berhasil Diperbarui!');
    }
}
