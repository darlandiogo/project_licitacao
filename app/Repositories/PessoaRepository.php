<?php

namespace App\Repositories;

use App\Models\Pessoa;
use App\Repositories\AddressRepository;
use App\Repositories\PhoneRepository;

class PessoaRepository implements Repository
{
    public function all($params)
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
                    (new PhoneRepository)->create([
                        'pessoa_id' => $pessoa->id,
                        'number' => $phone['number']
                    ]);
                }
            }
        }

        if(isset($pessoa->id) && isset($input['address']))
        {
            (new AddressRepository)->create([
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
                (new PhoneRepository)->deleteByPessoaId($pessoa->id);
                foreach($input['phones'] as $phone){
                    (new PhoneRepository)->create([
                        'pessoa_id' => $pessoa->id,
                        'number' => $phone['number']
                    ]);
                }
            }
        }

        $adrress = (new AddressRepository)->getByPessoaId($pessoa->id);
        if(isset($adrress) && isset($input['address']))
        {
            (new AddressRepository)->edit([
                'pessoa_id'     => $pessoa->id,
                'address'       => $input['address']['logradouro'],
                'number'        => $input['address']['numero'] ?? null,
                'complement'    => $input['address']['complemento'] ?? null,
                'postal_code'   => $input['address']['cep'],
                'neighborhood'  => $input['address']['bairro'],
                'city' => $input['address']['localidade'],
                'state' => $input['address']['uf']
            ],  $adrress->id);  
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        Pessoa::where('id',$id)->delete();

        $adrress = (new AddressRepository)->getByPessoaId($pessoa->id);
        if($adrress){
            (new AddressRepository)->deleteByPessoaId($adrress->id);
        }
        
        $phone = (new PhoneRepository)->getByPessoaId($id);
        if($phone) {
            (new PhoneRepository)->deleteByPessoaId($phone->id);
        }
       
        return true;
    }
}