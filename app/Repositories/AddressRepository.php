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
        //
    }

    public function edit($input, $id)
    {   
        $address = Address::where('pessoa_id',$id)->first();
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
            $address = Address::create([
                'pessoa_id' => $id,
                'address' => $input['address'],  
                'number'  => $input['number'],
                'complement' => $input['complement'],   
                'neighborhood' => $input['neighborhood'], 
                'postal_code' => $input['postal_code'],   
                'city' => $input['city'],   
                'state' => $input['state'], 
            ]);
        }
        return $this->getById($address->id);
    }

    public function delete($id)
    {
        //
    }
}