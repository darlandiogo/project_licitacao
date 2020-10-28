<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LicitacaoRequest;
use App\Repositories\LicitacaoRepository;

class LicitacaoController extends Controller
{
    protected $licitacaoRepository;

    public function __construct(LicitacaoRepository $licitacaoRepository)
    {
        $this->licitacaoRepository = $licitacaoRepository;   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['page', 'perPage', 'searchTerm']);
        return $this->licitacaoRepository->all($params);
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
     * return array content
     * modalities, types, forms and regimes in licitações
     */
    public function selectOptions()
    {
        return $this->licitacaoRepository->selectOptions();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicitacaoRequest $request)
    {
        $params =  $request->only([
            'process_number',
            'process_date',
            'bidding_number',
            'modality',
            'type',
            'form',
            'regime',
            'bidding_objective',
            'justification',
            'purpose_contract',
            'way_execution',
            'validity_contract',
            'deadline_contract',
            'general_considerations',
            'bidding_organ',
            'emiter_name',
            'emiter_office',
            'disbursement_schedule',
            'edital_date',
            'datetime_open',
            'status',
            'sector_id',
            'value',
        ]);

        return $this->licitacaoRepository->create($params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->licitacaoRepository->getById($id);
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
    public function update(LicitacaoRequest $request, $id)
    {
        $params =  $request->only([
            'process_number',
            'process_date',
            'bidding_number',
            'modality',
            'type',
            'form',
            'regime',
            'bidding_objective',
            'justification',
            'purpose_contract',
            'way_execution',
            'validity_contract',
            'deadline_contract',
            'general_considerations',
            'bidding_organ',
            'emiter_name',
            'emiter_office',
            'disbursement_schedule',
            'edital_date',
            'datetime_open',
            'status',
            'sector_id',
            'value',
        ]);
        
        return $this->licitacaoRepository->edit($params, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->licitacaoRepository->delete($id);
    }
}
