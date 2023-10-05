<?php

namespace App\Http\Controllers\Direksi;

use App\Http\Controllers\Controller;
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
        return view('halaman_direksi.direksi.supplier.index', [
            'title' => $title,
            'supplier' => $supplier
        ]);
    }
}
