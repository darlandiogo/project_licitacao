<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemRepository implements Repository
{
    public function all($params){

        $query = DB::table('items');
        $query->select(DB::raw("id, number, specification, quantity, unity, REPLACE(REPLACE(REPLACE(FORMAT(value, 2), '.', '#'), ',', '.'), '#', ',') as value"));
        $query->where('type', $params["type"]);
        $query->where('type_id', $params["type_id"]);

        if($params['searchTerm']){
            $query->where('number', 'like', '%' . $params['searchTerm'] . '%');
            $query->orWhere('specification', 'like', '%' . $params['searchTerm'] . '%');
            $query->orWhere('unity', 'like', '%' . $params['searchTerm'] . '%');
        }

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);

    }
    public function getById($id)
    {
        return Item::select(DB::raw("id, number, specification, quantity, unity, type, type_id, REPLACE(REPLACE(REPLACE(FORMAT(value, 2), '.', '#'), ',', '.'), '#', ',') as value"))
        ->where('id', $id)->firstOrFail();
    }
    public function create($input)
    {
        $item = Item::create([
            'number' => $input['number'],
            'specification' => $input['specification'],
            'quantity' => $input['quantity'],
            'unity' => $input['unity'],
            'type' => $input['type'],
            'type_id' => $input['type_id'],
            'value' => Item::formatMoneyDb($input['value']),
        ]);
        
        if($item)
            return true;

        return false;
        //return $this->getById($item->id);
    }
    public function edit($input, $id)
    {
        $item = Item::find($id);
        if($item){
            $item->number = $input['number'];
            $item->specification = $input['specification'];
            $item->quantity = $input['quantity'];
            $item->unity = $input['unity'];
            $item->type = $input['type'];
            $item->type_id = $input['type_id'];
            $item->value = Item::formatMoneyDb($input['value']);
            $item->save();
        }

        if($item)
            return true;
        
        return false;
        //return $this->getById($item->id);
    }
    public function delete($id)
    {
        // delete
    }

}