<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Order extends Model
{
    use HasFactory;
    protected $table = 'admin_purchase_order';
    protected $fillable = [
        'no_doku',
        'tgl_purchasing',
        'tipe_pr',
        'supplier',
        'pemohon',
        'accounting',
        'kasir',
        'menyetujui'
    ];
    public function purchase_order_detail()
    {
        return $this->hasMany(Purchase_Order_Detail::class, 'fk_po');
    }
}
