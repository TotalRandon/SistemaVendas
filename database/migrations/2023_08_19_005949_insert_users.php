<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            [
                'nome_usuario' => 'Joao',
                'email' => 'admin@example.com',
                'telefone' => '18911112222',
                'password' => Hash::make('password'),
            ],
            [
                'nome_usuario' => 'Victor',
                'email' => 'user1@example.com',
                'telefone' => '18933334444',
                'password' => Hash::make('password'),
            ],
            [
                'nome_usuario' => 'Pablo',
                'email' => 'pablo@example.com',
                'telefone' => '18933334444',
                'password' => Hash::make('password'),
            ],
            [
                'nome_usuario' => 'Rosi',
                'email' => 'rosi@example.com',
                'telefone' => '18933334444',
                'password' => Hash::make('password'),
            ],
            [
                'nome_usuario' => 'Max',
                'email' => 'max@example.com',
                'telefone' => '18933334444',
                'password' => Hash::make('password'),
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->whereIn('email', ['admin@example.com', 'user1@example.com'])->delete();
    }
};
