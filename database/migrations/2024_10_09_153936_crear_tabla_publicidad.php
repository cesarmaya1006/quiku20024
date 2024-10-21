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
        Schema::create('publicidad', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id', 'fk_cmr_rol_publicidad')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');
            $table->string('cliente');
            $table->string('tipo');
            $table->string('imagen');
            $table->string('url')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicidad');
    }
};
