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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_produto');
            $table->decimal('valor', 10, 2);
            $table->enum('forma_pagamento', ['cartao', 'boleto', 'pix']);
            $table->unsignedInteger('num_parcelas')->nullable();
            $table->decimal('valor_parcela')->nullable();
            $table->date('data_pagamento');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
