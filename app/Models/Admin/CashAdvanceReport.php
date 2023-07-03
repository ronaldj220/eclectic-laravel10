<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvanceReport extends Model
{
    use HasFactory;
    protected $table = 'admin_cash_advance_report';
    protected $fillable = [
        'no_doku',
        'tgl_diajukan',
        'judul_doku',
        'tipe_ca',
        'nominal_ca',
        'pemohon',
        'accounting',
        'kasir',
        'menyetujui',
        'status_approved',
        'status_paid'
    ];
    public function rb_detail()
    {
        return $this->hasMany(CashAdvanceReportDetail::class, 'fk_ca');
    }
}
