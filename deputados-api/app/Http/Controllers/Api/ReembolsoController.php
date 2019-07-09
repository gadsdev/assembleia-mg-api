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

    // Traz os gastos de todos os deputados com a API da Assembleia
    public function getDeputadosAssembleiaApi()
    {   
        $deputadosId = $this->getAllDeputados();

        for ($i=0; $i < 5; $i++) { 
           $url = "http://dadosabertos.almg.gov.br/ws/prestacao_contas/".
           "verbas_indenizatorias/deputados/15245/2017/5?formato=json"; 
           
           $gasto[$i] = json_decode(file_get_contents($url));
           $detalhesGastos = count($gasto[0]->list[0]->listaDetalheVerba);
           $gastoFormatado = array(               
               'quantGastos' => $detalhesGastos,
               'valorTotalMes' => $gasto[0]->list[0]->valor,
           );
        }
      
        /*
        foreach ($deputadosId as $key => $value) {
            $url = "http://dadosabertos.almg.gov.br/ws/prestacao_contas/".
            "verbas_indenizatorias/deputados/".$value."/2017/1?formato=json";  
            $gasto[$key] = json_decode(file_get_contents($url));
        }*/

       
          
        echo '<pre>' , var_dump($gastoFormatado) , '</pre>';
        die();
        return $diffDeputadosList;
    }

    public function getAllDeputados()
    {   
        $deputados = Deputado::where('id' ,'>' ,0)->pluck('id')->toArray();          
        
        
        return $deputados;
    }


}
