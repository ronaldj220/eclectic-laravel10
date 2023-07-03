<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvanceReportDetail extends Model
{
    use HasFactory;
    protected $table = 'admin_cash_advance_report_detail';
    protected $fillable = [
        'deskripsi',
        'bukti_ca',
        'no_bukti',
        'curr',
        'nominal',
        'tanggal_1',
        'tanggal_2',
        'fk_ca'
    ];
    public function reimbursement()
    {
        return $this->belongsTo(CashAdvanceReport::class, 'fk_ca');
    }
}
