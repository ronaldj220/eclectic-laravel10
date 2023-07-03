<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_Ticket_Detail extends Model
{
    use HasFactory;
    protected $table = 'admin_support_ticket_detail';
    protected $fillable = [
        'nama_karyawan',
        'aliases',
        'curr',
        'nominal_awal',
        'jam',
        'fk_support_ticket'
    ];
    public function support_ticket()
    {
        return $this->belongsTo(Reimbursement::class, 'fk_support_ticket');
    }
}
