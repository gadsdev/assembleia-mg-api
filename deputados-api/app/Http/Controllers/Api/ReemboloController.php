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

    public function findById($id)
    {
    	return Deputado::where('id', $id)->firstOrFail();
    }

    public function create(Request $request)
    {
        $data = $request->all();
        return Deputado::create($data);
    }

}
