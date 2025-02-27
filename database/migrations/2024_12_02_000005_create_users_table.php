<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');                        
            $table->string('cedula')->unique();
            $table->enum('genero', ['Masculino', 'Femenino'])->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('grado_id')->nullable()->constrained('grados')->onDelete('set null');
            $table->foreignId('seccion_id')->nullable()->constrained('secciones')->onDelete('set null');
            $table->string('especialidad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamp('ultimo_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};