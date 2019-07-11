<?php

use Illuminate\Database\Seeder;
use App\Deputado;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()   { 
        //Deputados
        $this->call(DeputadosTableSeeder::class);

        //Remmbolso
        $this->call(ReembolsoSeeder::class);

        //Redes Sociais
        $this->call(RedeSocialSeeder::class);
        
    } 
    
}
