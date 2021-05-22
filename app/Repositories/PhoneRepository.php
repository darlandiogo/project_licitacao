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

    public function getByPessoaId($id)
    {
        return Phone::where('pessoa_id', $id)->first();
    }

    public function create($input)
    {
        return Phone::create([
            'pessoa_id' => $input['pessoa_id'],
            'number'    => $input['number']
        ]);
    }

    public function edit($input, $id)
    {   
       //
    }

    public function editByPessoaId($input, $id)
    {
        $this->deleteByPessoaId($id);
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

    public function deleteByPessoaId($id)
    {
        return Phone::where('pessoa_id',$id)->delete();
    }
}