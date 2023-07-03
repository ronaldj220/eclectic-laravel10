<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Request extends Model
{
    use HasFactory;
    protected $table = 'admin_purchase_request';
    protected $fillable = [
        'no_doku',
        'tgl_diajukan',
        'pemohon',
        'menyetujui'
    ];
    public function purchase_request_detail()
    {
        return $this->hasMany(Purchase_Request_Detail::class, 'fk_pr');
    }
}
