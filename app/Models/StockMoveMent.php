<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMoveMent extends Model
{
    use HasFactory, HasUuids;
    //

    protected $fillable = ['material_id','product_id','production_log_id','warehouse_id', 'type', 'quantity','reference','created_by', 'date'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

        public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
