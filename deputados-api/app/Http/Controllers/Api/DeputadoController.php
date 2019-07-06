<?php

namespace App\Http\Controllers\Api;

use App\Http\ApiError;
use App\Deputado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeputadoController extends Controller
{
  	public function findAll()
    {
    	return Deputado::all();
    }

    public function findById(Deputado $id)
    {
    	return $id;
    }

    /*
    public function create(Request $request)
    {
		try {
			$deputadoData = $request->all();
			$this->product->create($deputadoData);
			$return = ['data' => ['msg' => 'Deputado ccadastrado com sucesso!']];
			return response()->json($return, 201);
		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de salvar', 1010),  500);
		}
    }*/
}
