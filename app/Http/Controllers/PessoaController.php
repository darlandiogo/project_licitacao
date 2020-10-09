<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PessoaRequest;
use App\Repositories\PessoaRepository;

class PessoaController extends Controller
{
    protected $pessoaRepository; 

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->pessoaRepository->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaRequest $request)
    {
        /** {
         *      name, birth_date, email 
         *      address: { ...APIViaCep, numero }
         *      phones: {[number]}
         * }
         */
       return $this->pessoaRepository->create($request->only(['name', 'birth_date', 'email', 'address', 'phones']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->pessoaRepository->getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request, $id)
    {
        return $this->pessoaRepository->edit($request->only(['name', 'birth_date', 'email', 'address', 'phones']), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->pessoaRepository->delete($id);
    }
}
