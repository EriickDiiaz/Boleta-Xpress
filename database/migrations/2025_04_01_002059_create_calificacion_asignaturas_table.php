<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calificaciones_asignaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boleta_id')->constrained('boletas')->onDelete('cascade');
            $table->foreignId('asignatura_id')->constrained('asignaturas');
            $table->text('descripcion')->nullable();
            $table->enum('calificacion_literal', ['A', 'B', 'C', 'D', 'E'])->nullable();
            $table->integer('calificacion_numerica')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calificaciones_asignaturas');
    }
};