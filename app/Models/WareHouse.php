<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    use HasFactory, HasUuids;
    //
    protected $fillable = ['name', 'location'];

    public function movements()
    {
        return $this->hasMany(StockMoveMent::class);
    }
}
