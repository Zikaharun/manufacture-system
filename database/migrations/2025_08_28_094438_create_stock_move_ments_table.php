<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_move_ments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('material_id');
            $table->uuid('warehouse_id')->nullable();
            $table->enum('type', ['in', 'out']);
            $table->decimal('quantity', 16, 6);
            $table->string('reference')->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamps();


            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('ware_houses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_move_ments');
    }
};
