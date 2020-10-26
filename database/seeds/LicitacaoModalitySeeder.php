<?php

use Illuminate\Database\Seeder;
use App\Models\LicitacaoModality;
class LicitacaoModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            'Concorrência', 'Leilão', 'Concurso',
            'Pregão Presencial', 'Pregão Eletrônico',
            'Chamamento público', 'Adesão SRP', 'Outros'
        ];

        foreach($contents as $content)
        {
            LicitacaoModality::create([
                'name' => $content
            ]);
        }


        $this->command->info('LicitacaoModalitySeeder has been Created!');
    }
}
