Laravel - Assembleia-mg-api
================================
 Um script para consumir os dados abertos da Assembléia Legislativa do Estado de Minas Gerais e retornar dados especificos em JSON.
    

Installation
------------

Renomear .env.example para .env e configuere o banco de dados
    
Config Data Base
    
    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

Run 

    composer install
Run

    php artisan migrate:refresh --seed

## REST APIs
### [ /api/deputado
|  					            |          	|					                    |
| ------------- 			    | ----------| -----------------------------------	|
|- Criar Deputado   			| `POST`	|[/deputado](#post-deputado)		    |
|- Traz todos Deputados  		| `GET`		|[/deputado](#get-deputado)		        |
|- Traz um Deputado por ID    	| `GET`    	|[/deputado/{id}](#get-deputadoid)   	|

### [ /api/remmbolso
|  					                |          	|					                    |
| ------------- 			        | ----------| -----------------------------------	|
|- Criar um Reembolso   		    | `POST`	|[/remmbolso](#post-remmbolso)		    |
|- Listatodos os Reembolsos		    | `GET`		|[/remmbolso](#get-remmbolso)	        |
|- Top 5 de Reembolsos por mês    	| `GET`    	|[/remmbolso/{mes}](#get-remmbolsomes)	|

## REST APIs
### [ /api/rede_social
|  					                            |          	|				             |
| ------------- 			                    | ----------| -----------------	         |
|- Criar uma Rede Social		                | `POST`  |[/deputado](#post-rede)       |
|- Traz as redes ordenado pelas mais usadas  	| `GET`	  |[/deputado](#get-rede)	     |
|- Traz uma rede por ID    	                    | `GET`   |[/deputado/{id}](#get-redeid)|

## Request & Response Examples

### /deputado

### POST /deputado

- Criar deputado

	- Example: http://localhost:8000/api/deputado

Request:

    {
        	"id": "1",
	        "name": "Pedro"
    }

### GET /deputado

- Listar todas Deputados

	- Example: http://localhost:8000/api/deputado

Response:

	
  {
    "id": 12193,
    "name": "Adalclever Lopes",
    "created_at": "2019-07-11 23:05:37",
    "updated_at": "2019-07-11 23:05:37"
  },
  {
    "id": 5888,
    "name": "Adelmo Carneiro Leão",
    "created_at": "2019-07-11 23:05:37",
    "updated_at": "2019-07-11 23:05:37"
  },
  {
    "id": 15245,
    "name": "Agostinho Patrus",
    "created_at": "2019-07-11 23:05:37",
    "updated_at": "2019-07-11 23:05:37"
  },
    

### GET /deputado/id

- Exibir uma categoria especifica

	- Example: http://localhost:8000/api/deputado/15245

Response:

    {
    "id": 15245,
    "name": "Agostinho Patrus",
    "created_at": "2019-07-11 23:05:37",
    "updated_at": "2019-07-11 23:05:37"
    }


### /remmbolso

### POST /remmbolso

- Criar reembolso

	- Example: http://localhost:8000/api/remmbolso

Request:

    {	
        "mes": 2,
        "total_reembolsado": 2.30,
        "deputado_id": 12193        
    }

### GET /remmbolsos

- Listar todos remmbolsos

	- Example: http://localhost:8000/api/remmbolso

Response:

	
  {
    "id": 1,
    "mes": 1,
    "total_reembolsado": "0",
    "deputado_id": 12193,
    "created_at": "2019-07-11 23:06:13",
    "updated_at": "2019-07-11 23:06:13"
  },
  {
    "id": 2,
    "mes": 1,
    "total_reembolsado": "0",
    "deputado_id": 5888,
    "created_at": "2019-07-11 23:06:14",
    "updated_at": "2019-07-11 23:06:14"
  },
  {
    "id": 3,
    "mes": 1,
    "total_reembolsado": "2286.29",
    "deputado_id": 15245,
    "created_at": "2019-07-11 23:06:14",
    "updated_at": "2019-07-11 23:06:14"
  },
    

### GET /remmbolsos/mes

- Exibir o top 5 de maiores reembolsos por mês

	- Example: http://localhost:8000/api/remmbolso/1

Response:


  {
    "nome": "Sávio Souza Cruz",
    "remmbolso": "8426.25",
    "mes": 1
  },
  {
    "nome": "Leonídio Bouças",
    "remmbolso": "7124.11",
    "mes": 1
  },
  {
    "nome": "Arlen Santiago",
    "remmbolso": "7081.64",
    "mes": 1
  },
  {
    "nome": "Tadeu Martins Leite",
    "remmbolso": "6848.15",
    "mes": 1
  },
  {
    "nome": "Hely Tarqüínio",
    "remmbolso": "6654.56",
    "mes": 1
  }


### /rede_social

### POST /rede_social

- Criar uma rede_social 

	- Example: http://localhost:8000/api/rede_social

Request:
{	
	"id": 0,
	"nome": "Facebook",
	"url": "http://www.facebook.com",
	"deputado_id": 12193	
}

### GET /rede_social

- Listar todas redes sociais, ordenando pelas mais usadas

	- Example: http://localhost:8000/api/rede_social

Response:


  {
    "nome": "Facebook"
  },
  {
    "nome": "Instagram"
  },
  {
    "nome": "Twitter"
  },
  {
    "nome": "Youtube"
  }


### GET /rede_social/id

- Traz uma rede social por ID

	- Example: http://localhost:8000/api/rede_social/0

Response:

{
  "id": 0,
  "nome": "Facebook",
  "url": "http:\/\/www.facebook.com",
  "deputado_id": 7752,
  "created_at": "2019-07-11 23:06:16",
  "updated_at": "2019-07-11 23:06:16"
}


