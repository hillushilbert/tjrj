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
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->unsignedBigInteger('Livro_Codl');
            $table->unsignedBigInteger('Assunto_codAs');
            $table->foreign('Livro_Codl','Livro_Assunto_FKIndex1')->on('Livro')->references('Codl');
            $table->foreign('Assunto_codAs','Livro_Assunto_FKIndex2')->on('Assunto')->references('codAs');
            $table->primary(['Livro_Codl','Assunto_codAs']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Assunto');
    }
};
