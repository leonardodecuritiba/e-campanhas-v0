<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':Attribute deve ser aceito.',
    'active_url' => ':Attribute não é uma URL válida.',
    'after' => ':Attribute deve ser uma data depois de :date.',
    'alpha' => ':Attribute deve conter somente letras.',
    'alpha_dash' => ':Attribute deve conter letras, números e traços.',
    'alpha_num' => ':Attribute deve conter somente letras e números.',
    'array' => ':Attribute deve ser um array.',
    'before' => ':Attribute deve ser uma data antes de :date.',
    'between' => [
        'numeric' => ':Attribute deve estar entre :min e :max.',
        'file' => ':Attribute deve estar entre :min e :max kilobytes.',
        'string' => ':Attribute deve estar entre :min e :max caracteres.',
        'array' => ':Attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => ':Attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação de :attribute não confere.',
    'date' => ':Attribute não é uma data válida.',
    'date_format' => ':Attribute não confere com o formato :format.',
    'different' => ':Attribute e :other devem ser diferentes.',
    'digits' => ':Attribute deve ter :digits dígitos.',
    'digits_between' => ':Attribute deve ter entre :min e :max dígitos.',
    'email' => ':Attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'filled' => ':Attribute é um campo obrigatório.',
    'image' => ':Attribute deve ser uma imagem.',
    'in' => ':Attribute é inválido.',
    'integer' => ':Attribute deve ser um inteiro.',
    'ip' => ':Attribute deve ser um endereço IP válido.',
    'json' => ':Attribute deve ser um JSON válido.',
    'max' => [
        'numeric' => ':Attribute não deve ser maior que :max.',
        'file' => ':Attribute não deve ter mais que :max kilobytes.',
        'string' => ':Attribute não deve ter mais que :max caracteres.',
        'array' => ':Attribute não deve ter mais que :max itens.',
    ],
    'mimes' => ':Attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => ':Attribute deve ser no mínimo :min.',
        'file' => ':Attribute deve ter no mínimo :min kilobytes.',
        'string' => ':Attribute deve ter no mínimo :min caracteres.',
        'array' => ':Attribute deve ter no mínimo :min itens.',
    ],
    'not_in' => 'O :attribute selecionado é inválido.',
    'numeric' => ':Attribute deve ser um número.',
    'regex' => 'O formato de :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless' => 'O :attribute é necessário a menos que :other esteja em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same' => ':Attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => ':Attribute deve ser :size.',
        'file' => ':Attribute deve ter :size kilobytes.',
        'string' => ':Attribute deve ter :size caracteres.',
        'array' => ':Attribute deve conter :size itens.',
    ],
    'string' => ':Attribute deve ser uma string',
    'timezone' => ':Attribute deve ser uma timezone válida.',
    'unique' => ':Attribute já está em uso.',
    'uploaded' => 'Falha no upload da :attribute.',
    'url' => 'O formato de :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'birthday' => [
            'before_or_equal' => ':Attribute precisa estar no passado.',
        ],
        'death_date' => [
            'before_or_equal' => ':Attribute precisa estar no passado.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
	    'image' => 'Imagem',
	    'name' => 'Nome',
	    'email' => 'Email',
	    'login' => 'Login',
	    'password' => 'Senha',
	    'password_confirmation' => 'Repetir a Senha',
	    'user_password' => 'Senha',
	    'user_password_confirmation' => 'Repetir a Senha',
	    'description' => 'Descrição',
	    'descriptions' => 'Descrições',
	    'to'=>'Campo "Das:"',
	    'from'=>'Campo "Até às:"',
	    'dates'=>'Dias',
	    'category'=>'Categoria',
	    'show_image'=>'Imagem de apresentação',
	    'content'=>'Conteúdo',
	    'cpf'=>'CPF',
	    'rg'=>'RG',
	    'ie'=>'Inscrição Estadual',
	    'foundation'=>'Data de Fundação',
	    'fantasy_name' =>'Nome Fantasia',
	    'company_name' =>'Razão Social',
	    'birthday'     => 'Data de Nascimento',
	    'favored_cnpj' => 'CNPJ do Favorecido',
	    'favored_cpf'  => 'CPF do Favorecido',
	    'favored_name' => 'Nome do Favorecido',
	    'bank'         => 'Banco',
	    'agency'       => 'Agência',
	    'account'      => 'Conta',
	    'product_id'   => 'Produto',
	    'brand_id'     => 'Marca',
	    'value'        => 'Valor',
	    'quantity'     => 'Quantidade',
	    'role_id'      => 'Nível de Permissão',
	    'title'        => 'Título',
	    'city_id'      => 'Cidade',
	    'state_id'     => 'Estado',
	    'link'          => 'Arquivo',
	    'function'     => 'Função',
	    'cover'         => 'Capa do Trabalho',
	    'short_image'  => 'Imagem',
	    'file_import'  => 'Arquivo de Importação',
	    'surname'      => 'Apelido',
	    'years_approximate'      => 'Idade Aproximada',
	    'death'      => 'Óbito',
	    'death_date'      => 'Data de Óbito',
	    'whatsapp'      => 'Whatsapp',
	    'other_phones'      => 'Outros telefones',
	    'instagram'      => 'Instagram',
        'voter_registration_zone'=> 'nº Zona Eleitoral',
        'voter_registration_session' => 'nº Seção Eleitoral',
        'votes_estimate' => 'Estimativa votos',
        'votes_degree_certainty' => 'Grau de certeza de voto',
        'social_history' => 'Histórico Função Social',
        'location_of_operation' => 'Localidade de atuação',

    ],


    /*
    |--------------------------------------------------------------------------
    | Others
    |--------------------------------------------------------------------------
    |
    |
    */

    'cpf' => 'CPF inválido!',
    'cpf_mascara' => 'CPF inválido!',

];
