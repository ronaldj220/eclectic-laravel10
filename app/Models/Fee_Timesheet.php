<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_Timesheet extends Model
{
    use HasFactory;
    protected $table = 'fee_timesheet';
    protected $fillable = [
        'hari',
        'nominal'
    ];
}
