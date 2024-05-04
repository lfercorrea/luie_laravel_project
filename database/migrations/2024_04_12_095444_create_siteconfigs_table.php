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
        Schema::create('siteconfigs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('brand');
            $table->string('brand_logo');
            $table->string('endereco');
            $table->text('sobre_empresa');
            $table->text('sobre_produtos');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siteconfigs');
    }
};
