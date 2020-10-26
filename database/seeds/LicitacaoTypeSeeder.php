<?php


use Illuminate\Database\Seeder;
use App\Models\LicitacaoType;

class LicitacaoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            
            'Menor preço (por item)',
            'Menor preço (por lote)',
            'Menor preço (global)',
            'Melhor técnica',
            'Técnica e preço',
            'Maior desconto',
            'Maior desconto (por item)',
            'Maior lance ou oferta',
            'Outros',
         ];
 
         foreach($contents as $content)
         {
             LicitacaoType::create([
                 'name' => $content
             ]);
         }
 
 
         $this->command->info('LicitacaoTypeSeeder has been Created!');   
    }
}
