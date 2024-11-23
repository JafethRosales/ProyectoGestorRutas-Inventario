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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('name');
            $table->string('calle_numero');
            $table->string('colonia');
            $table->string('codigo_postal');
            $table->decimal('credito', $precision = 10, $scale = 2)->default(0);
            $table->decimal('limite_credito', $precision = 10, $scale = 2)->default(0);
            $table->softDeletes($column = 'deleted_at', $precision= 0);
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
        Schema::dropIfExists('clientes');
    }
};
