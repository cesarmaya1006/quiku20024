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
        Schema::create('construc_areas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id', 'fk_area_construc_areas')->references('id')->on('construc_areas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('constructora_id');
            $table->foreign('constructora_id', 'fk_area_constructoras')->references('id')->on('constructoras')->onDelete('restrict')->onUpdate('restrict');
            $table->string('area');
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
        Schema::dropIfExists('construc_areas');
    }
};
