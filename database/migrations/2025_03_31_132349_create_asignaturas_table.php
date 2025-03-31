<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grado_id')->nullable();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignaturas');
    }
};