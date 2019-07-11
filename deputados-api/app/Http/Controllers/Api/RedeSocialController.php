<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RedeSocial;
use App\Deputado;

class RedeSocialController extends Controller
{
    public function findById($id)
    {
    	return RedeSocial::where('id', $id)->firstOrFail();
    }

    public function create(Request $request)
    {
        $data = $request->all();
        return RedeSocial::create($data);
    }

    public function getRedesMaisUsadas() { 
       $redes = RedeSocial::select('nome')
        ->groupBy('nome')
        ->orderByRaw('COUNT(*) DESC')       
        ->get();

        return $redes;
    }
    
}
