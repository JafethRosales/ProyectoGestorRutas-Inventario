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
        Schema::table('inventarios', function (Blueprint $table) {
            $table->integer('existencias')->default(0)->change();
        });
        Schema::table('inventarios', function (Blueprint $table) {
            $table->decimal('flete')->default(0)->change();
        });
        Schema::table('inventarios', function (Blueprint $table) {
            $table->decimal('precio_compra')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
