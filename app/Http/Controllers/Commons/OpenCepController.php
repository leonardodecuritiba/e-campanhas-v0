<?php
namespace App\Http\Controllers\Commons;

use App\Contracts\OpenCepInterface;
use App\Http\Controllers\Controller;

class OpenCepController extends Controller
{
    protected $cepService;

    public function __construct(OpenCepInterface $cepService)
    {
        $this->cepService = $cepService;
    }

    public function listCountries()
    {
        $countries = $this->cepService->listCountries();
        return response()->json($countries);
    }

    public function listUfs()
    {
        $ufs = $this->cepService->listUfs();
        return response()->json($ufs);
    }

    public function listCities(string $uf)
    {
        $cities = $this->cepService->listCities($uf);
        return response()->json($cities);
    }

    public function getAddressByCep(string $cep)
    {
        $address = $this->cepService->getAddressByCep($cep);
        return response()->json($address);
    }

    public function getAddressByStreet(string $uf, string $city, string $street = null, string $district = null)
    {
        $address = $this->cepService->getAddressByStreet($uf, $city, $street, $district);
        return response()->json($address);
    }
}
