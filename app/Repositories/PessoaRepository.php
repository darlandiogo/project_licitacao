<?php

namespace App\Repositories;

use App\Models\Pessoa;
use App\Models\Address;
use App\Models\Phone;

class PessoaRepository implements Repository
{
    public function all()
    {
        return Pessoa::with('address')->with('phones')->get();
    }
    
    public function getById($id){
        return Pessoa::with('address')->with('phones')->findOrFail($id);
    }

    public function create($input)
    {
        $pessoa = Pessoa::create([
            'name' => $input['name'],
            'birth_date' => $input['birth_date'] ?? null,
            'email' => $input['email'] ?? null
        ]);

        if(isset($pessoa->id) && isset($input['phones']))
        {
            if(is_array($input['phones']))
            {
                foreach($input['phones'] as $phone){
                    Phone::create([
                        'pessoa_id' => $pessoa->id,
                        'number' => $phone['number']
                    ]);
                }
            }
        }

        if(isset($pessoa->id) && isset($input['address']))
        {
            Address::create([
                'pessoa_id'     => $pessoa->id,
                'address'       => $input['address']['logradouro'],
                'number'        => $input['address']['numero'] ?? null,
                'complement'    => $input['address']['complemento'] ?? null,
                'postal_code'   => $input['address']['cep'],
                'neighborhood'  => $input['address']['bairro'],
                'city' => $input['address']['localidade'],
                'state' => $input['address']['uf']
            ]);
        }

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        $pessoa = Pessoa::find($id);
        if($pessoa)
        {
            $pessoa->name = $input['name'];
            $pessoa->birth_date = $input['birth_date'] ?? null;
            $pessoa->email = $input['email'] ?? null ;
            $pessoa->save();
        }

        if(isset($pessoa->id) && isset($input['phones']))
        {   
            if(is_array($input['phones']))
            {
                Phone::where('pessoa_id', $pessoa->id)->delete();
                foreach($input['phones'] as $phone){
                    Phone::create([
                        'pessoa_id' => $pessoa->id,
                        'number' => $phone['number']
                    ]);
                }
            }
        }

        $adrress = Address::find($pessoa->id);
        if(isset($adrress) && isset($input['address']))
        {
            $adrress->pessoa_id     = $pessoa->id;
            $adrress->address       = $input['address']['logradouro'];
            $adrress->number        = $input['address']['numero'] ?? null;
            $adrress->complement    = $input['address']['complemento'] ?? null;
            $adrress->postal_code   = $input['address']['cep'];
            $adrress->neighborhood  = $input['address']['bairro'];
            $adrress->city = $input['address']['localidade'];
            $adrress->state = $input['address']['uf'];
            
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        Pessoa::where('id',$id)->delete();
        Address::where('pessoa_id',$id)->delete();
        Phone::where('pessoa_id',$id)->delete();
        return true;
    }
}