<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialUsage extends Model
{
    //
    use HasFactory, HasUuids;

    protected $table = 'material_usages';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'work_order_id',
        'material_id',
        'quantity',
        'used_by',
    ];

    // Relasi ke WorkOrder
    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    // Relasi ke Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Relasi ke User (yang menggunakan material)
    public function user()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
}
