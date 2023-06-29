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
        Schema::create('ninios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero_child')->unique();
            $table->string('nombres_completos');
            $table->enum('genero',['Male','Female'])->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->foreignId('comunidad_id')->constrained('comunidads');
            $table->enum('estado',['ACTIVO','INACTIVO'])->nullable();
            $table->string('email')->nullable();
            $table->string('numero_celular')->nullable();
            $table->text('fcm_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ninios');
    }
};
