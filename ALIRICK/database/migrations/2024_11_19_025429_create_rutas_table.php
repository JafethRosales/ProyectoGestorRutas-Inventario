<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->time('hora_inicio')->useCurrent();
            $table->time('hora_termino')->nullable($value = true);
            $table->decimal('venta_total', $precision = 10, $scale = 2)->default(0);
            $table->decimal('credito_recuperado', $precision = 10, $scale = 2)->default(0);
            $table->decimal('credito_generado', $precision = 10, $scale = 2)->default(0);
            $table->decimal('total_liquidar', $precision = 10, $scale = 2)->default(0);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutas');
    }
};
