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
        Schema::create('Livro', function (Blueprint $table) {
            $table->id('Codl');
            $table->string('Titulo',40);
            $table->string('Editora',40);
            $table->unsignedInteger('Edicao');
            $table->string('AnoPublicacao',4);
            $table->decimal('Valor',11,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro');
    }
};
