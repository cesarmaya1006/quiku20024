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
        Schema::create('construc_empleados', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->foreign('id', 'fk_empleado_contruc_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id', 'fk_empleado_construc_cargos')->references('id')->on('construc_cargos')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id', 'fk_empleado_contruc_tipo_documentos')->references('id')->on('tipo_documentos')->onDelete('restrict')->onUpdate('restrict');
            $table->string('identificacion')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
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
        Schema::dropIfExists('construc_empleados');
    }
};
