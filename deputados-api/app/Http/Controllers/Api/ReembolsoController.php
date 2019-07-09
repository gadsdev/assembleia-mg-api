<?php

namespace App\Http\Controllers\Api;

use App\Http\ApiError;
use App\ReembolsoIndenisacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

}
