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

    public function getDeputadosAssembleiaApi()
    {
        $urlEmMandato = "http://dadosabertos.almg.gov.br/ws/legislaturas/".
        "17/deputados/em_exercicio?formato=json";
        $urlSemMandato ="http://dadosabertos.almg.gov.br/ws/legislaturas/".
        "18/deputados/que_exerceram_mandato?formato=json";

        $deputadosEmMandato = json_decode(file_get_contents($urlEmMandato));
        $deputadosSemMandato = json_decode(file_get_contents($urlEmMandato));

        $diffDeputadosList = $this->
        diffContentDeputado($deputadosEmMandato,$deputadosSemMandato);
       

        echo '<pre>' , var_dump($diffDeputadosList) , '</pre>';
        //echo "Nome: $value->nome ID: $value->id </br>";
        //echo "Nome: $value1->nome ID: $value1->id </br>"; 

        //return $url;
    }

    public function diffContentDeputado($deputadosEmMandato, $deputadosSemMandato) {
        $i = 0;
        foreach ($deputadosEmMandato->list as $key => $value) {
            foreach ($deputadosSemMandato->list as $key1 => $value1) {
                if($value->id == $value1->id){
                    $deputadosList[$i] = array(
                        'id' => $value->id,
                        'name' => $value->nome
                    ) ; 
                    $deputadosList[$i+1] = array(
                        'id' => $value1->id,
                        'name' => $value1->nome
                    ) ; 
                    $i++;              
                }                     
            }     
        }

        return $deputadosList;
    }
}
