<?php

namespace App\Repositories;

use App\Models\Representante;

class RepresentanteRepository implements Repository
{
    public function all($params)
    {
        //
    }
    
    public function getById($id){
       //
    }

    public function create($input)
    {
        //
    }

    public function edit($input, $id)
    {   
        Representante::where('pessoa_juridica_id',$id)->delete();
        foreach($input['pessoa_fisica'] as $pessoa_fisica){
            Representante::create([
                'pessoa_juridica_id' => $id,
                'pessoa_id' => $pessoa_fisica
            ]);
        }
        return Representante::where('pessoa_juridica_id', $id)->get();
    }

    public function delete($id)
    {
        //
    }
}