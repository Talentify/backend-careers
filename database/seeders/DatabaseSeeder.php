<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ]);

        \DB::table('job')->insert([
            'title' => 'Desenvolvedor Web',
            'description' => \Str::random(500),
            'status' => 1,
            'workplace' => 'São Paulo, SP',
            'salary' => 3500.00
        ]);

        \DB::table('job')->insert([
            'title' => 'Assistente Jurídico',
            'description' => \Str::random(300),
            'status' => 1,
            'workplace' => 'Rio de Janeiro, RJ',
            'salary' => 1850.00
        ]);

        \DB::table('job')->insert([
            'title' => 'Analista de RH',
            'description' => \Str::random(500),
            'status' => 1,
            'workplace' => 'Salvador, BA',
            'salary' => 1850.00
        ]);

        \DB::table('job')->insert([
            'title' => 'Diretor de Arte',
            'description' => \Str::random(800),
            'status' => 1,
            'workplace' => 'Porto Alegre, RS',
            'salary' => 6000.00
        ]);

        \DB::table('job')->insert([
            'title' => 'Publicitário',
            'description' => \Str::random(400),
            'status' => 1,
            'workplace' => 'Porto Alegre, RS',
            'salary' => 3000.00
        ]);
    }
}
