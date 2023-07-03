<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Menyetujui extends Model
{
    use HasFactory;
    protected $table = 'menyetujui';
    protected $fillable = [
        'email',
        'nama',
        'password',
        'jabatan'
    ];
}
