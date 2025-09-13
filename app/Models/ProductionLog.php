<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLog extends Model
{
    //
     use HasFactory, HasUuids;

    protected $table = 'production_logs';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'work_order_id',
        'quantity_produced',
        'reject_quantity',
        'production_date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke WorkOrder
    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    // App\Models\ProductionLog.php
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
