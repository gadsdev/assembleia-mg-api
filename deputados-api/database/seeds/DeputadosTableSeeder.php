<?php

use Illuminate\Database\Seeder;
use App\Deputado;

class DeputadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deputados = $this->getDeputadosAssembleiaApi();    
        foreach ($deputados as $key => $value) { 
            $deputado = Deputado::firstOrCreate(
                ['id' => $value->id], ['name' => $value->name]
             );
         }
    }

    // Traz os deputados da API da Assembleia
    public function getDeputadosAssembleiaApi()
    {
        //O 17 representa uma legislatura em que passou o ano de 2017
        $urlEmMandato = "http://dadosabertos.almg.gov.br/ws/legislaturas/".
        "17/deputados/em_exercicio?formato=json";
        $urlSemMandato ="http://dadosabertos.almg.gov.br/ws/legislaturas/".
        "17/deputados/que_exerceram_mandato?formato=json";
  
        $deputadosEmMandato = json_decode(file_get_contents($urlEmMandato));
        $deputadosSemMandato = json_decode(file_get_contents($urlEmMandato));
  
        $diffDeputadosList = $this->
        diffContentDeputado($deputadosEmMandato,$deputadosSemMandato);      
  
        return $diffDeputadosList;
    }
  
    // Traz um array de deputados retirando repetencias
    public function diffContentDeputado($deputadosEmMandato, $deputadosSemMandato) {
        $i = 0;       
        foreach ($deputadosEmMandato->list as $key => $value) {
            foreach ($deputadosSemMandato->list as $key1 => $value1) {
                if($value->id == $value1->id){
                    $deputadosListAtual[$i] = array(
                        'id' => $value->id,
                        'name' => $value->nome
                    ) ; 
                    $deputadosListEx[$i] = array(
                        'id' => $value1->id,
                        'name' => $value1->nome
                    ) ; 
                    $deputadosArr = array_merge($deputadosListAtual, $deputadosListEx);
                    $deputadosObjArr = json_decode(json_encode($deputadosArr), FALSE);
                    $i++;              
                }                     
            }     
        }
  
        return $deputadosObjArr;
    }
}
