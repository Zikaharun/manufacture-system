<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderItem extends Model
{
    //
    use HasFactory, HasUuids;
    protected $fillable = [
        'purchase_order_id', 'material_id', 'quantity','unit', 'unit_price', 'total_price'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
