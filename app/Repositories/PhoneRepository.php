<?php

namespace App\Repositories;

use App\Models\Phone;

class PhoneRepository implements Repository
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
        Phone::where('pessoa_id',$id)->delete();
        foreach($input['numbers'] as $number){
            Phone::create([
                'pessoa_id' => $id,
                'number' => $number
            ]);
        }
        return Phone::where('pessoa_id', $id)->get();
    }

    public function delete($id)
    {
        //
    }
}