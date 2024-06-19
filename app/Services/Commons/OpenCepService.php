<?php

namespace App\Services\Commons;

use App\Contracts\OpenCepInterface;
use GuzzleHttp\Client;
use App\Exceptions\OpenCepException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class OpenCepService implements OpenCepInterface
{
    protected function connect($service,$args = []){
        try {
            $client = new Client();
            $url = config('opencep.host') . $service . "/" . "?" . http_build_query($args) ;
            $response = $client->request('GET', $url,
                [
                    'headers' => [
                        'Authorization' => 'Token token='.config('opencep.token')
                    ]
                ]);
            $content = $response->getBody()->getContents();
            return json_decode($content);
        } catch (Exception $e){
            dd($e);
            report($e);
            switch($e->getCode()){
                case 500:
                    throw new OpenCepException('Erro ao consultar serviço rest do NeoCep.',500);
                case 404:
                    throw new OpenCepException('Parametros incompletos ou serviço não encontrado no NeoCep.',404);
                default:
                    throw new OpenCepException('Erro inesperado ao conectar ao serviço REST do NeoCep. Exception:'.$e->getMessage(),$e->getCode());
            }
        }
    }

    public function listCountries(): array
    {
        return [
            "BRA" => "Brasil"
        ];
    }

    public function listUfs(string $pais = "BRA"): array
    {
        $ufs = [
            "BRA" => [
                "AC"=>"Acre",
                "AL"=>"Alagoas",
                "AM"=>"Amazonas",
                "AP"=>"Amapá",
                "BA"=>"Bahia",
                "CE"=>"Ceará",
                "DF"=>"Distrito Federal",
                "ES"=>"Espírito Santo",
                "GO"=>"Goiás",
                "MA"=>"Maranhão",
                "MT"=>"Mato Grosso",
                "MS"=>"Mato Grosso do Sul",
                "MG"=>"Minas Gerais",
                "PA"=>"Pará",
                "PB"=>"Paraíba",
                "PR"=>"Paraná",
                "PE"=>"Pernambuco",
                "PI"=>"Piauí",
                "RJ"=>"Rio de Janeiro",
                "RN"=>"Rio Grande do Norte",
                "RO"=>"Rondônia",
                "RS"=>"Rio Grande do Sul",
                "RR"=>"Roraima",
                "SC"=>"Santa Catarina",
                "SE"=>"Sergipe",
                "SP"=>"São Paulo",
                "TO"=>"Tocantins"
            ],
        ];
        return $ufs[$pais];
    }

    public function listCities(string $uf)
    {
        return cache()->remember('cidades'.$uf, config('opencep.time-cache'), function() use ($uf) {
            return $this->connect('cities', ['estado' => $uf]);
        });
    }

    public function getAddressByCep(string $cep)
    {
        return $this->connect('cep',['cep'=>$cep]);
    }

    public function getAddressByStreet(string $uf, string $city, string $street = null, string $district = null)
    {
        return $this->connect('address',['estado'=>$uf,'cidade'=>$city,'logradouro'=>$street,'bairro'=>$district]);
    }

    public function getGeo(float $lat, float $lng)
    {
        return $this->connect('nearest',['lat'=>$lat,'lng'=>$lng]);
    }
}
