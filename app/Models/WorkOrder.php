<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory, HasUuids;
    //

    protected $fillable = ['product_id','wo_code', 'quantity', 'planned_start_date',
    'planned_end_date', 'status', 'created_by'];

    protected $casts = [
        'planned_start_date' => 'date',
        'planned_end_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ✅ Relasi ke MaterialUsage
    public function materialUsages()
    {
        return $this->hasMany(MaterialUsage::class, 'work_order_id');
    }

    // ✅ Relasi ke ProductionLog
    public function productionLogs()
    {
        return $this->hasMany(ProductionLog::class, 'work_order_id');
    }

    
}
