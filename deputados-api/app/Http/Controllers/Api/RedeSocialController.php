<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RedeSocial;
use App\Deputado;

class RedeSocialController extends Controller
{
    public function findAll()
    {
    	return RedeSocial::all();
    }

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
        $deputadosId = $this->getAllDeputados();        
       
        //foreach ($deputadosId as $key => $value) {
            $url = "http://dadosabertos.almg.gov.br/ws/deputados/12195?formato=json";
            try {
                $redes = json_decode(file_get_contents($url));
                if(isset($redes->deputado->redesSociais)){
                    $todasRedes = $redes->deputado->redesSociais;
                    for ($i=0; $i  <= count($todasRedes) ; $i++) { 
                        $arrCadaRede = $redes->deputado->redesSociais[$i]->redeSocial;
                        //echo $arrCadaRede->nome." </br>";
                        $redesUsadas[$i] = array(
                            "id" => $arrCadaRede->id,
                            "nome" => $arrCadaRede->nome, 
                            "url" => $arrCadaRede->url, 
                        );
                        
                    }
                }                
            } catch (\Throwable $th) {
                
            }  
        //}

        echo '<pre>' , var_dump($redesUsadas) , '</pre>';
        die();
    } 

    public function getAllDeputados()
    {   
        $deputados = Deputado::where('id' ,'>' ,0)->pluck('id')->toArray();
        
        return $deputados;
    }
}
