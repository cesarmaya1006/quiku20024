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
        Schema::create('arquitecto_departamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('arquitecto_id');
            $table->foreign('arquitecto_id', 'fk_arquitecto_departamentos')->references('id')->on('arquitectos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id', 'fk_departamento_arquitecto')->references('id')->on('departamentos')->onDelete('restrict')->onUpdate('restrict');
            $table->unique(['arquitecto_id','departamento_id'],'cmr_unico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquitecto_departamentos');
    }
};
