<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $fillable = [
        'nama_supplier',
        'PIC',
        'menyetujui',
        'no_rekening',
        'bank',
        'pemilik_bank'
    ];
}
