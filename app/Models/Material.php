<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, HasUuids;
    //
    protected $fillable = ['name', 'unit','cost_price','stock','minimum_stock'];

    public function movements()
    {
        return $this->hasMany(StockMoveMent::class);
    }

    public function boms()
    {
        return $this->hasMany(BillOfMaterial::class);
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class, 'purchase_order_items')->withPivot('quantity','unit_price','total_price')->withTimestamps();
    }


}
