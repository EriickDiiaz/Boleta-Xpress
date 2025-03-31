<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('escuela_id')->constrained('escuelas')->onDelete('cascade');
            $table->foreignId('grado_id')->constrained('grados')->onDelete('cascade');
            $table->foreignId('seccion_id')->constrained('secciones')->onDelete('cascade');
            $table->string('nombres');
            $table->string('apellidos');
            $table->enum('genero', ['Masculino', 'Femenino'])->nullable();
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('nombre_representante')->nullable();
            $table->string('cedula_representante')->nullable();
            $table->string('telefono_representante')->nullable();
            $table->string('correo_representante')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};