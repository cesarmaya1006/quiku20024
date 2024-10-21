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
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id', 'fk_area_area')->references('id')->on('areas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('regional_id');
            $table->foreign('regional_id', 'fk_area_regionales')->references('id')->on('regionales')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('areas');
    }
};
