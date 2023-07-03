<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_Project extends Model
{
    use HasFactory;
    protected $table = 'fee_project';
    protected $fillable = [
        'nominal'
    ];
}
