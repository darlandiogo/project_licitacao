<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneRequest;
use App\Repositories\PhoneRepository;

class PhoneController extends Controller
{
    protected $phoneRepository;
    public function __construct(PhoneRepository $phoneRepository)
    {   
        $this->phoneRepository = $phoneRepository;
    }
    
    public function update(PhoneRequest $request){
        return $this->phoneRepository->edit(
            $request->only([  
                'numbers'
            ]), 
            $request->input('pessoa_id')
        );
    }
}
