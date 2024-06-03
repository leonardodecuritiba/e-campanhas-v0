<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    | Model - Procedure Type - Message Type
    | Example 1: Fans (S)tore (S)uccess
    | Example 2: Fans (U)pdate (E)rror
    */
    'view' => [
        'DATA' => 'Dados',

        //STORE
        'CREATE'    => 'Cadastrar :name',
        'IMPORT'    => 'Importar :name',
        'IMPORTXML' => 'Importar XML :name',
        'IMPORTCONTRACTXML' => 'Editar Contratos',
        'ASSIGN'    => 'Assinar Plano',
        'EDIT'      => 'Editar :name',
        'INDEX'     => 'Listar :name',
        'REPORT'    => 'Relatórios de :name',
        'NORESULTS' => [
	        'M' => ['Nenhum :name encontrado!'],
	        'F' => ['Nenhuma :name encontrada!'],
        ],
        'OPEN'      => 'Abrir :name',
        'SHOW'      => 'Visualizar :name',
        'PROFILE'   => 'Meu Perfil',
        'REMOVEDS'  => 'Removidos',
        'UNASSOCIATED'  => 'Não Associados',
        'LAUNCH'  => 'CTRB Parceiro',
    ],
	'data' => [
		'registers' => '{0} Nenhum|[1] :value Registro Blockchain|[2,*] :value Registros Blockchain'

	]

];
