<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('titulo');
            $table->string('categoria')->default('Condições Tratadas');
            $table->string('resumo', 500)->nullable();
            $table->longText('conteudo');
            $table->string('imagem')->nullable();
            $table->string('autor')->default('Mubissule — Centro de Medicina Natural');
            $table->boolean('publicado')->default(true);
            $table->timestamp('publicado_em')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artigos');
    }
};
