<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Order_Detail extends Model
{
    use HasFactory;
    protected $table = 'admin_purchase_order_detail';
    protected $fillable = [
        'judul',
        'jumlah',
        'satuan',
        'nominal',
        'PPH_23',
        'diskon',
        'ctm_1',
        'ctm_2'
    ];
    public function purchase_order()
    {
        return $this->belongsTo(Purchase_Order::class, 'fk_po');
    }
}
