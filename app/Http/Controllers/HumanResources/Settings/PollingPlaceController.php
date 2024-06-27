<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\Settings\PollingPlaceRequest;
use App\Http\Resources\HumanResources\Settings\PollingPlaceResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PollingPlaceController extends Controller {

	/**
	 * gET the specified resource from storage.
	 *
	 * @return AnonymousResourceCollection
     */
	public function index(PollingPlaceRequest $request) //: AnonymousResourceCollection
    {
        $values = [
            'CEJA - ANTIGA EEB. LAUREANO PACHECO',
            'CENTRO EDUCACIONAL MUNICIPAL ARIRIBÁ',
            'CENTRO EDUCACIONAL MUNICIPAL DO ESTALEIRO DONA LILA',
            'CENTRO EDUCACIONAL MUNICIPAL DONA LILI',
            'CENTRO EDUCACIONAL MUNICIPAL GIOVANIA DE ALMEIDA',
            'CENTRO EDUCACIONAL MUNICIPAL GOVERNADOR IVO SILVEIRA',
            'CENTRO EDUCACIONAL MUNICIPAL PRESIDENTE MÉDICI',
            'CENTRO EDUCACIONAL MUNICIPAL PROFESSOR ANTÔNIO LÚCIO',
            'CENTRO EDUCACIONAL MUNICIPAL TAQUARAS',
            'CENTRO EDUCACIONAL MUNICIPAL VEREADOR SANTA',
            'CENTRO EDUCACIONAL SISTEMA UNIFICADO',
            'COLÉGIO LICEU CATARINENSE',
            'COLÉGIO SALESIANO',
            'ESCOLA DE EDUCAÇÃO BÁSICA PRESIDENTE JOÃO GOULART',
            'ESCOLA DE EDUCAÇÃO BÁSICA PROFESSORA FRANCISCA ALVES GEVAERD',
            'ESCOLA DE EDUCAÇÃO BÁSICA PROFESSORA MARIA DA GLÓRIA PEREIRA',
            'FACULDADE AVANTIS',
            'NÚCLEO DE EDUCAÇÃO INFANTIL CARROSSEL',
            'CENTRO EDUCACIONAL MUNICIPAL JARDIM IATE CLUBE',
            'CENTRO EDUCACIONAL MUNICIPAL NOVA ESPERANÇA',
            'CENTRO EDUCACIONAL MUNICIPAL PROFESSOR ARMANDO CÉSAR GHISLANDI',
            'UNIVALI - UNIVERSIDADE DO VALE DO ITAJAI - CAMPUS II'
        ];
        if($request->has('term') && $request->get('term') != '') {
            $term = strtoupper($request->get('term'));
            $values = array_filter($values, function($item) use ($term) {
                return strpos($item, $term) !== false;
            });
        }
        return PollingPlaceResource::collection($values);
	}
}
