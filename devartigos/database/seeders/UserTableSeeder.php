<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'João Silva',
                'email' => 'joao@example.com',
                'password' => Hash::make('123456'),
                'seniority' => 'Jr',
                'skills' => json_encode(['PHP', 'Laravel']),
                'cep' => '01001-000',
                'street' => 'Rua das Flores',
                'number' => '100',
                'complement' => 'Apto 12',
                'neighborhood' => 'Centro',
                'city' => 'São Paulo',
                'state' => 'SP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Souza',
                'email' => 'maria@example.com',
                'password' => Hash::make('123456'),
                'seniority' => 'Pl',
                'skills' => json_encode(['Laravel', 'Vue']),
                'cep' => '20040-010',
                'street' => 'Av. Atlântica',
                'number' => '500',
                'complement' => null,
                'neighborhood' => 'Copacabana',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Pereira',
                'email' => 'carlos@example.com',
                'password' => Hash::make('123456'),
                'seniority' => 'Sr',
                'skills' => json_encode(['PHP', 'Laravel', 'Vue', 'Docker']),
                'cep' => '30140-120',
                'street' => 'Rua Minas Gerais',
                'number' => '45',
                'complement' => 'Sala 10',
                'neighborhood' => 'Savassi',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
