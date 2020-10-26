<?php

use Illuminate\Database\Seeder;
use App\Models\LicitacaoRegime;

class LicitacaoRegimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            
            'Empreitada por preço global',
            'Empreitada por preço unitário',
            'Tarefa',
            'Empreitada Integral',
            'Outros',
         ];
 
         foreach($contents as $content)
         {
             LicitacaoRegime::create([
                 'name' => $content
             ]);
         }
 
 
         $this->command->info('LicitacaoRegimeSeeder has been Created!');
    }
}
