<?php

namespace App\Http\Controllers\Api;

use App\Http\ApiError;
use App\ReembolsoIndenisacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deputado;

class ReembolsoController extends Controller
{    
  	public function findAll()
    {
    	return ReembolsoIndenisacao::all();
    }

    public function findById($id)
    {
    	return ReembolsoIndenisacao::where('id', $id)->firstOrFail();
    }

    public function create(Request $request)
    {
        $data = $request->all();
        return ReembolsoIndenisacao::create($data);
    }

    public function getMaiorGasto($mes) {
        try {
            $valores = ReembolsoIndenisacao::where('mes', '=', $mes)
            ->orderBy('total_reembolsado', 'desc')
            ->take(5)->get();
            
            foreach ($valores as $key => $value) {
               
                $deputado = Deputado::find($value->deputado_id);
                
                $gasto[$key] = array(
                    'nome' => $deputado->name,
                    'remmbolso' => $value->total_reembolsado,
                    'mes' => $value->mes,                
                );
            }     
            if(isset($gasto)) return $gasto;           
        } catch (\Throwable $th) {
            throw $th;
        }        
    }

}
