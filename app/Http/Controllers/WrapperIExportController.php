<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ItemRepository;
use App\Repositories\LicitacaoRepository;
use App\Models\Item;
use Exception;

class WrapperIExportController extends Controller
{
    protected $itemRepository;
    protected $licitacaoRepository;

    public function __construct(ItemRepository $itemRepository, LicitacaoRepository $licitacaoRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->licitacaoRepository = $licitacaoRepository;
    }

    public function import (Request $request)
    {

        $validate = Validator::make($request->only(['type', 'type_id', 'file']),[
            'type' => 'required',
            'type_id' => 'required',
            'file' => 'required',
        ]);

        if($validate->fails()){
            return response()->json(['error' => 'Ocorreu um erro, tente novamente!'], 422);
        }
        
       $file = base64_decode($request->input('file'));

       $mime_type = finfo_buffer(finfo_open(), $file, FILEINFO_MIME_TYPE);

       if( $mime_type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            return response()->json(['error' => 'tipo de arquivo não suportado'], 422);
       }
       
       /**
        * find licitacao and get sector id (9,10) to identifier sector with item necessary.
        */

       $file_path = 'storage/'.uniqid().'.xlsx';

       file_put_contents($file_path, $file);

       
       $collections = (new FastExcel)->import($file_path);

       try{
            foreach($collections as $collection){
                Item::create([
                    'number' => $collection["Número"],
                    'specification' => $collection['Especificação'],
                    'quantity' => $collection['Quantidade'],
                    'unity' => $collection['Unidade'],
                    'type' => $request->input('type'),
                    'type_id' => $request->input('type_id'),
                    'value' => Item::formatMoneyDb($collection['Valor Unitário']),
                ]);
            } 
        }
        catch(Exception $e){
            // tratar linhas não inseridas...
        }
   
       return response()->json(['success' => 'dados importados com sucesso']);  

        
    }

    public function export (Request $request)
    {
        $validate = Validator::make($request->only(['type', 'type_id']),[
            'type' => 'required',
            'type_id' => 'required',
        ]);

        if($validate->fails()){
            return response()->json(['error' => 'Ocorreu um erro, tente novamente!'], 422);
        }
        
        $items = $this->itemRepository->export($request->only(['type', 'type_id']));
        if($items->isEmpty()){
            return response()->json(['error' => 'items estão vazios.'], 404);
        }

        $name = 'file.xlsx';
        if($request->input("type") === 'licitacao'){
            $result = $this->licitacaoRepository->getById($request->input("type_id"));
            $result->licitacao_modality->name .' '.$result->process_number. '.xlsx';
        }
         
        $path  = (new FastExcel($items))->export('storage/'.uniqid().'.xlsx');
        return response()->json([
            'name' => $name,
            'file' => base64_encode(file_get_contents($path)),
        ]);
        
    }
}
