<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rb_Detail extends Model
{
    use HasFactory;
    protected $table = 'admin_rb_detail';
    protected $fillable = [
        'deskripsi',
        'bukti_reim',
        'no_bukti',
        'curr',
        'nominal',
        'tanggal_1',
        'tanggal_2',
        'fk_rb'
    ];
    public function reimbursement()
    {
        return $this->belongsTo(Reimbursement::class, 'fk_rb');
    }
}
