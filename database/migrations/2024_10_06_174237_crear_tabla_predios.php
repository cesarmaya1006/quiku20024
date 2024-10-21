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
        Schema::create('predios', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_usuario_predio')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipo_inmueble_id');
            $table->foreign('tipo_inmueble_id', 'fk_tipo_inmueble_predio')->references('id')->on('tipo_inmuebles')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('regional_id');
            $table->foreign('regional_id', 'fk_regional_predio')->references('id')->on('regionales')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id', 'fk_municipio_predio')->references('id')->on('municipios')->onDelete('restrict')->onUpdate('restrict');
            $table->string('ubicacion');
            $table->string('avaluo_corporativo');
            $table->string('solicitud_avaluo')->default(0);
            $table->bigInteger('precio');
            $table->longText('descripcion')->nullable();
            $table->string('direccion')->nullable();
            $table->double('area');
            $table->string('tipo_area');
            $table->bigInteger('visto')->default(0);
            $table->boolean('propio')->default(1);
            $table->string('estado')->default('activo');
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
        Schema::dropIfExists('predios');
    }
};
