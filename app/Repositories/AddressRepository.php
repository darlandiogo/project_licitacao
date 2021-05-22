<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository implements Repository
{
    public function all($params)
    {
        //
    }
    
    public function getById($id){
       return Address::findOrFail($id);
    }

    public function create($input)
    {
        return Address::create([
            'pessoa_id'     => $input['pessoa_id'],
            'address'       => $input['address'],
            'number'        => $input['number'] ?? null,
            'complement'    => $input['complement'] ?? null,
            'postal_code'   => $input['postal_code'],
            'neighborhood'  => $input['neighborhood'],
            'city'          => $input['city'],
            'state'         => $input['state']
        ]);
    }

    public function edit($input, $id)
    {   
        $address = $this->getById($id);
        if($address){
            $address->address = $input['address'];
            $address->number  = $input['number'];
            $address->complement    = $input['complement'];
            $address->neighborhood  = $input['neighborhood'];
            $address->postal_code   = $input['postal_code'];
            $address->city  = $input['city'];
            $address->state = $input['state']; 
            $address->save(); 
            return true;
        }
        return  false;
    }

    public function editByPessoaId($input, $id)
    {   
        $address = $this->getByPessoaId($id);
        if($address){
            $address->address = $input['address'];
            $address->number  = $input['number'];
            $address->complement    = $input['complement'];
            $address->neighborhood  = $input['neighborhood'];
            $address->postal_code   = $input['postal_code'];
            $address->city  = $input['city'];
            $address->state = $input['state']; 
            $address->save(); 
        }
        else {
            $input['pessoa_id'] =  $id;
            $address = $this->create($input);
        }
        return $this->getById($address->id);
    }

    public function getByPessoaId($id)
    {
        return Address::where('pessoa_id', $id)->first();
    }

    public function delete($id)
    {
        //
    }

    public function deleteByPessoaId($id)
    {
        return Address::where('pessoa_id',$id)->delete();
    }
}