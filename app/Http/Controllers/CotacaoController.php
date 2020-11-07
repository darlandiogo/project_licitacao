<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CotacaoRequest;
use App\Repositories\CotacaoRepository;

class CotacaoController extends Controller
{
    protected $cotacaoRepository;


    public function __construct(CotacaoRepository $cotacaoRepository)
    {
        $this->cotacaoRepository = $cotacaoRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['page', 'perPage', 'searchTerm','type', 'type_id']);
        return $this->cotacaoRepository->all($params);
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
    public function store(CotacaoRequest $request)
    {
        $params = $request->only([
            'process_number',
            'process_date',
            'purpose_bidding',
        ]);

        return $this->cotacaoRepository->create($params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->cotacaoRepository->getById($id);
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
        $params = $request->only([
            'process_number',
            'process_date',
            'purpose_bidding',
        ]);

        return $this->cotacaoRepository->edit($params, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->cotacaoRepository->delete($id);
    }
}
