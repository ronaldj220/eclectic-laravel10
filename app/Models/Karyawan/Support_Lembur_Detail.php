<?php

namespace App\Models\Karyawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_Lembur_Detail extends Model
{
    use HasFactory;
    protected $table = 'karyawan_support_lembur_detail';
    protected $fillable = [
        'nama_karyawan',
        'aliases',
        'curr',
        'nominal_awal',
        'jam',
        'fk_support_lembur'
    ];
    public function support_lembur()
    {
        return $this->belongsTo(Reimbursement::class, 'fk_support_lembur');
    }
}
