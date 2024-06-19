<?php
namespace App\Contracts;

interface OpenCepInterface
{
    public function listCountries(): array;

    public function listUfs(): array;

    public function listCities(string $uf);

    public function getAddressByCep(string $cep);

    public function getAddressByStreet(string $uf, string $city, string $street = null, string $district = null);

    public function getGeo(float $lat, float $lng);
}