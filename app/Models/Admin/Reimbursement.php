<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $table = 'admin_reimbursement';
    protected $fillable = [
        'no_doku',
        'tgl_diajukan',
        'judul_doku',
        'pemohon',
        'accounting',
        'kasir',
        'menyetujui',
        'bukti_timesheet_project',
        'bukti_support_ticket',
        'bukti_support_lembur',
        'halaman',
        'status_approved',
        'status_paid',
    ];
    public function rb_detail()
    {
        return $this->hasMany(Rb_Detail::class, 'fk_rb');
    }
}
