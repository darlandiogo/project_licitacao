<?php

use Illuminate\Database\Seeder;
use App\Models\LicitacaoStatus;

class LicitacaoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            'Fase interna',
            'Em andamento',
            'Adjudicado',
            'Homologado',
            'Deserto',
            'Fracassado',
            'Anulado',
            'Cancelado',
            'Revogado',
            'Suspenso',
            'Concluído'
         ];
 
         foreach($contents as $content)
         {
            LicitacaoStatus::create([
                 'name' => $content
             ]);
         }
 
 
         $this->command->info('LicitacaoStatusSeeder has been Created!');
    }
}
