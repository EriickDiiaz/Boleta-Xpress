<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
            $table->foreignId('escuela_id')->constrained();
            $table->foreignId('grado_id')->constrained();
            $table->foreignId('seccion_id')->constrained('secciones');
            $table->foreignId('ano_escolar_id')->constrained('anos_escolares');
            $table->string('proyecto')->nullable();
            $table->string('momento');
            $table->enum('tipo_boleta', ['descriptiva', 'calificativa'])->default('descriptiva');
            $table->text('observaciones')->nullable();
            $table->enum('calificacion_general', ['A', 'B', 'C', 'D', 'E'])->nullable();            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boletas');
    }
};