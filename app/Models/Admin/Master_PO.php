<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_PO extends Model
{
    use HasFactory;
    protected $table = 'master_po';
    protected $fillable = [
        'VAT',
        'PPH',
        'PPH_4',
        'PPH_21'
    ];
}
