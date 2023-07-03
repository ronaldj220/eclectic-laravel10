<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Request_Detail extends Model
{
    use HasFactory;
    protected $table = 'admin_purchase_request_detail';
    protected $fillable = [
        'judul',
        'tgl_1',
        'tgl_2',
        'jumlah',
        'satuan',
        'tgl_pakai',
        'project',
        'fk_pr'
    ];
    public function purchase_request()
    {
        return $this->belongsTo(Purchase_Request::class, 'fk_pr');
    }
}
