<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository )
    {
        $this->itemRepository = $itemRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['page', 'perPage', 'searchTerm','type', 'type_id']);
        return $this->itemRepository->all($params);
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
    public function store(ItemRequest $request)
    {
        $params = $request->only([
            'number',
            'specification',
            'quantity',
            'unity',
            'type',
            'type_id',
            'value', 
        ]);

        return $this->itemRepository->create($params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->itemRepository->getById($id);
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
    public function update(ItemRequest $request, $id)
    {
        $params = $request->only([
            'number',
            'specification',
            'quantity',
            'unity',
            'type',
            'type_id',
            'value', 
        ]);

        return $this->itemRepository->edit($params, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->itemRepository->delete($id);
    }
}
