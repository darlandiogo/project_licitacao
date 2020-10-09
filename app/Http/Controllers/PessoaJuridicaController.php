<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaJuridicaRequest;
use App\Repositories\PessoaJuridicaRepository;

class PessoaJuridicaController extends Controller
{
    protected $pessoaJuridicaRepository;

    public function __construct(PessoaJuridicaRepository $pessoaJuridicaRepository)
    {
        $this->pessoaJuridicaRepository = $pessoaJuridicaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->pessoaJuridicaRepository->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PessoaJuridicaRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaJuridicaRequest $request)
    {
        /** 
         * pessoa_id, ci, cpf, type,
         * { 
            "pessoa_id": 1,
            "cnpj": 13309434444,
            "razao_social": "empresa XPTO",
            "type": "servidor"
        }  
        */  
        return $this->pessoaJuridicaRepository->create($request->only(['pessoa_id', 'razao_social', 'cnpj', 'type']));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $this->pessoaJuridicaRepository->getById($id);
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
    public function update(PessoaJuridicaRequest $request, $id)
    {
        //
        return $this->pessoaJuridicaRepository->edit($request->only(['pessoa_id', 'razao_social', 'cnpj', 'type']), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return $this->pessoaJuridicaRepository->delete($id);
    }
}
