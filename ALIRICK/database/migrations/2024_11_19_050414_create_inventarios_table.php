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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('existencias');
            $table->decimal('flete', $precision = 10, $scale = 2);
            $table->decimal('precio_compra', $precision = 10, $scale = 2);
            $table->decimal('suma', $precision = 10, $scale = 2);
            $table->decimal('porcentaje_incremento', $precision = 10, $scale = 2);
            $table->decimal('porcentaje_utilidad', $precision = 10, $scale = 2);
            $table->decimal('precio_base', $precision = 10, $scale = 2);
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
        Schema::dropIfExists('inventarios');
    }
};
