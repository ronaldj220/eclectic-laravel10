<?php

namespace App\Models\Karyawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet_Project_Detail extends Model
{
    use HasFactory;
    protected $table = 'karyawan_timesheet_project_detail';
    protected $fillable = [
        'nama_karyawan',
        'curr',
        'nominal_awal',
        'hari_awal',
        'hari',
        'fk_timesheet_project'
    ];
    public function timesheet_project()
    {
        return $this->belongsTo(Reimbursement::class, 'fk_timesheet_project');
    }
}
