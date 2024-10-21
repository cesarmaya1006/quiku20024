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
        Schema::create('arquitecto_tipoinmuebles', function (Blueprint $table) {
            $table->unsignedBigInteger('arquitecto_id');
            $table->foreign('arquitecto_id', 'fk_arquitecto_tipoinmuebles')->references('id')->on('arquitectos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipo_inmueble_id')->nullable();
            $table->foreign('tipo_inmueble_id', 'fk_tipo_inmueble_arquitecto')->references('id')->on('tipo_inmuebles')->onDelete('restrict')->onUpdate('restrict');
            $table->unique(['arquitecto_id','tipo_inmueble_id'],'cmr_unico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquitecto_tipoinmuebles');
    }
};
