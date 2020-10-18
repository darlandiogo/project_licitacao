<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PessoaFisicaRequest;
use App\Repositories\PessoaFisicaRepository;

class PessoaFisicaController extends Controller
{
    protected $pessoaFisicaRepository;

    public function __construct(PessoaFisicaRepository $pessoaFisicaRepository)
    {
        $this->pessoaFisicaRepository = $pessoaFisicaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['page', 'perPage', 'searchTerm']);
        return $this->pessoaFisicaRepository->all($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PessoaFisicaRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaFisicaRequest $request)
    {
        /** 
         * name, email, birthy_date, ci, cpf, type,
         *
        */  
        return $this->pessoaFisicaRepository->create(
            $request->only(['name', 'email', 'birth_date', 'ci', 'cpf', 'type'])
        );

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
        return $this->pessoaFisicaRepository->getById($id);
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
    public function update(PessoaFisicaRequest $request, $id)
    {
        //
        return $this->pessoaFisicaRepository->edit(
            $request->only(['name', 'email', 'birth_date', 'ci', 'cpf', 'type']), 
            $id
        );
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
        return $this->pessoaFisicaRepository->delete($id);
    }
}
