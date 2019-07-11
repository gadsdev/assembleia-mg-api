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
       $redes = RedeSocial::select('nome')
        ->groupBy('nome')
        ->orderByRaw('COUNT(*) DESC')       
        ->get();

        return $redes;
    }

    public function getRedesSociais() {        
        $deputadosId = $this->getAllDeputados();        
        $countData = 0;
        foreach ($deputadosId as $key => $value) {
            $url = "http://dadosabertos.almg.gov.br/ws/deputados/".$value
            ."?formato=json";           
                $redes = json_decode(@file_get_contents($url));
                if(isset($redes->deputado->redesSociais)){
                    $todasRedes = $redes->deputado->redesSociais;
                    for ($i=0; $i  <= count($todasRedes) ; $i++) { 
                        if(isset($redes->deputado->redesSociais[$i])){
                            $arrCadaRede = $redes->deputado->redesSociais[$i]->redeSocial;
                            //echo $arrCadaRede->nome." </br>";
                            /*$redesUsadas[$countData] = array(
                                "id" => $arrCadaRede->id,
                                "nome" => $arrCadaRede->nome, 
                                "url" => $arrCadaRede->url, 
                            );*/
                            $redesSociais = new RedeSocial;
                            $redesSociais->id =  $arrCadaRede->id;
                            $redesSociais->nome = $arrCadaRede->nome;
                            $redesSociais->url = $arrCadaRede->url;
                            $redesSociais->deputado_id = $value;
                            $redesSociais->save();
                        }
                    }
                    $countData++;
                } 
        }
        
    } 

    public function getAllDeputados()
    {   
        $deputados = Deputado::where('id' ,'>' ,0)->pluck('id')->toArray();
        
        return $deputados;
    }
}
