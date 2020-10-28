<?php

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
        //$this->call(UserSeeder::class);
        //$this->call(LicitacaoModalitySeeder::class);
        //$this->call(LicitacaoTypeSeeder::class);
        //$this->call(LicitacaoFormSeeder::class);
        //$this->call(LicitacaoRegimeSeeder::class);
        $this->call(LicitacaoStatusSeeder::class);
    }
}
