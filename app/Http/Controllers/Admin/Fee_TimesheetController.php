<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fee_TimesheetController extends Controller
{
    public function index()
    {
        $title = 'Master Biaya Timesheet';
        $dataTimesheet = DB::table('fee_timesheet')->paginate(10);
        return view('halaman_admin.fee_timesheet.index', [
            'title' => $title,
            'timesheet' => $dataTimesheet
        ]);
    }
    public function tambah_fee_timesheet()
    {
        $title = 'Tambah Biaya Timesheet';
        return view('halaman_admin.fee_timesheet.tambah_fee_timesheet', [
            'title' => $title
        ]);
    }
    public function simpan_fee_timesheet(Request $request)
    {
        DB::table('fee_timesheet')->insert([
            'hari' => $request->hari,
            'nominal' => $request->nominal
        ]);
        return redirect()->route('admin.master_timesheet')->with('success', 'Data Timesheet Berhasil Ditambahkan!');
    }
    public function edit_fee_timesheet($id)
    {
        $dataTimesheetEdit = DB::table('fee_timesheet')->where('id', $id)->first();
        $title = 'Edit Biaya Timesheet';
        return view('halaman_admin.fee_timesheet.edit_timesheet', [
            'title' => $title,
            'timesheet' => $dataTimesheetEdit
        ]);
    }
    public function update_fee_timesheet(Request $request, $id)
    {
        DB::table('fee_timesheet')->where('id', $id)->update([
            'hari' => $request->hari,
            'nominal' => $request->nominal
        ]);
        return redirect()->route('admin.master_timesheet')->with('success', 'Data Timesheet Berhasil Diperbarui!');
    }
    public function hapus_fee_timesheet($id)
    {
        DB::table('fee_timesheet')->where('id', $id)->delete();
        return redirect()->route('admin.master_timesheet')->with('success', 'Data Timesheet Berhasil Dihapus!');
    }
}
