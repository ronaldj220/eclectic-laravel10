<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Kasir extends Model
{
    use HasFactory;
    protected $table = 'kasir';
    protected $fillable = [
        'email',
        'password',
        'nama'
    ];
}
