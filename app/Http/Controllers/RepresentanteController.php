<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentanteRequest;
use App\Repositories\RepresentanteRepository;

class RepresentanteController extends Controller
{
    protected $representanteRepository;
    public function __construct(RepresentanteRepository $representanteRepository)
    {   
        $this->representanteRepository = $representanteRepository;
    }
    
    public function update(RepresentanteRequest $request){
        return $this->representanteRepository->edit(
            $request->only([  
                'pessoa_fisica'
            ]), 
            $request->input('pessoa_juridica_id')
        );
    }
}
