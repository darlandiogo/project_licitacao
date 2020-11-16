<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CotacaoEmpresaRepository;

class CotacaoEmpresaController extends Controller
{
    protected $cotacaoEmpresaRepository;

    public function __construct(CotacaoEmpresaRepository $cotacaoEmpresaRepository)
    {
        $this->cotacaoEmpresaRepository = $cotacaoEmpresaRepository; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $request->validate([
            'cotacao_id'=> 'required',
            'pessoa_juridica_id' => 'required',
        ]);

        return $this->cotacaoEmpresaRepository->create($request->only(['cotacao_id', 'pessoa_juridica_id']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->cotacaoEmpresaRepository->getById($id);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'pessoa_juridica' => 'required'
        ]);
        
        return $this->cotacaoEmpresaRepository->edit($request->only(['pessoa_juridica']), $id);
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
    }
}
