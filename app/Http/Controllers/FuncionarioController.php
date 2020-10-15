<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FuncionarioRquest;
use App\Repositories\FuncionarioRepository;

class FuncionarioController extends Controller
{
    protected $funcionarioRepository;

    public function __construct(FuncionarioRepository $funcionarioRepository)
    {
        $this->funcionarioRepository = $funcionarioRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['page', 'perPage', 'searchTerm']);
        return $this->funcionarioRepository->all($params);
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
    public function store(FuncionarioRquest $request)
    {
        //
        /**
         * pessoa_fisica_id, matricula, type_contract, role, sector, portaria
         */
        return $this->funcionarioRepository->create($request->only(['pessoa_fisica_id', 'matricula', 'type_contract', 'role', 'sector', 'portaria']));
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
        return $this->funcionarioRepository->getById($id);
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
    public function update(FuncionarioRquest $request, $id)
    {
        //
        /**
         * pessoa_fisica_id, matricula, type_contract, role, sector, portaria
         */
        return $this->funcionarioRepository->edit($request->only(['pessoa_fisica_id', 'matricula', 'type_contract', 'role', 'sector', 'portaria']),$id);
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
        return $this->funcionarioRepository->delete($id);
    }
}
