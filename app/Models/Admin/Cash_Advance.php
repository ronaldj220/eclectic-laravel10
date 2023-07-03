<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash_Advance extends Model
{
    use HasFactory;
    protected $table = 'admin_cash_advance';
    protected $fillable = [
        'no_doku',
        'tgl_diajukan',
        'tgl_diajukan2',
        'judul_doku',
        'curr',
        'nominal',
        'pemohon',
        'accounting',
        'kasir',
        'menyetujui',
    ];
}
