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
        Schema::table('stock_move_ments', function (Blueprint $table) {
            //
             $table->dropForeign(['material_id']);

            // ubah jadi nullable
            $table->uuid('material_id')->nullable()->change();

            // tambahkan lagi foreign key constraint
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_move_ments', function (Blueprint $table) {
            //
            $table->dropForeign(['material_id']);
            $table->uuid('material_id')->nullable(false)->change();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }
};
