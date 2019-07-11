<?php

use Illuminate\Database\Seeder;
use App\Deputado;
use App\RedeSocial;

class RedeSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->getRedesSociais();
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
