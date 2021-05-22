<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddrressRequest;
use App\Repositories\AddressRepository;

class AddrressController extends Controller
{
    protected $addressRepository;
    public function __construct(AddressRepository $addressRepository)
    {   
        $this->addressRepository = $addressRepository;
    }
    
    public function update(AddrressRequest $request){
        
        return $this->addressRepository->editByPessoaId(
            $request->only([
                'address',  
                'number',
                'complement',   
                'neighborhood',  
                'postal_code',   
                'city',   
                'state'  
            ]), 
            $request->input('pessoa_id')
        );
    }
}
