<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    //
    use HasFactory, HasUuids;
    protected $fillable = [
        'purchase_order_id', 'material_id', 'quantity', 'unit_price', 'total_price'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
