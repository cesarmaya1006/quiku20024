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
        Schema::create('arquitecto_municipios', function (Blueprint $table) {
            $table->unsignedBigInteger('arquitecto_id');
            $table->foreign('arquitecto_id', 'fk_arquitecto_municipios')->references('id')->on('arquitectos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id', 'fk_municipio_arquitecto')->references('id')->on('municipios')->onDelete('restrict')->onUpdate('restrict');
            $table->unique(['arquitecto_id','municipio_id'],'cmr_unico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquitecto_municipios');
    }
};
