<?php

use Illuminate\Database\Seeder;
use App\Models\LicitacaoForm;

class LicitacaoFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
           'Execução Direta',
           'Execução Indireta (Apenas para Obras e Serviços Art. 10, Lei 8.666/93)',
           'Outros',
        ];

        foreach($contents as $content)
        {
            LicitacaoForm::create([
                'name' => $content
            ]);
        }


        $this->command->info('LicitacaoFormSeeder has been Created!');
    }
}
