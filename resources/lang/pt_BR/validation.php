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

    'accepted'             => 'O campo :attribute deve ser aceito!',
    'active_url'           => 'O campo :attribute não é uma URL válida!',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date!',
    'after_or_equal'       => 'O campo :attribute deve ser uma data posterior ou igual a :date!',
    'alpha'                => 'O campo :attribute só pode conter letras!',
    'alpha_dash'           => 'O campo :attribute só pode conter letras, números e traços!',
    'alpha_num'            => 'O campo :attribute só pode conter letras e números!',
    'array'                => 'O campo :attribute deve ser uma matriz!',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date!',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date!',
    'between'              => [
        'numeric' => 'O campo :attribute deve ser entre :min e :max!',
        'file'    => 'O campo :attribute deve ser entre :min e :max kilobytes!',
        'string'  => 'O campo :attribute deve ser entre :min e :max caracteres!',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens!',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso!',
    'confirmed'            => 'O campo :attribute de confirmação não confere!',
    'date'                 => 'O campo :attribute não é uma data válida!',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format!',
    'different'            => 'Os campos :attribute e :other devem ser diferentes!',
    'digits'               => 'O campo :attribute deve ter :digits dígitos!',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos!',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas!',
    'distinct'             => 'O campo :attribute campo tem um valor duplicado!',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido!',
    'exists'               => 'O campo :attribute selecionado é inválido!',
    'file'                 => 'O campo :attribute deve ser um arquivo!',
    'filled'               => 'O campo :attribute o campo deve ter um valor!',
    'image'                => 'O campo :attribute deve ser uma imagem!',
    'in'                   => 'O campo :attribute selecionado é inválido!',
    'in_array'             => 'O campo :attribute não existe em :other!',
    'integer'              => 'O campo :attribute deve ser um número inteiro!',
    'ip'                   => 'O campo :attribute deve ser um endereço de IP válido!',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido!',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido!',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida!',
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser superior a :max!',
        'file'    => 'O campo :attribute não pode ser superior a :max kilobytes!',
        'string'  => 'O campo :attribute não pode ser superior a :max caracteres!',
        'array'   => 'O campo :attribute não pode ter mais do que :max itens!',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo de tipo: :values!',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo de tipo: :values!',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min!',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes!',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres!',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens!',
    ],
    'not_in'               => 'O campo :attribute selecionado é inválido!',
    'numeric'              => 'O campo :attribute deve ser um número!',
    'present'              => 'O campo :attribute deve estar presente!',
    'regex'                => 'O campo :attribute tem um formato inválido!',
    'required'             => 'O campo :attribute é obrigatório!',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value!',
    'required_unless'      => 'O campo :attribute é obrigatório exceto quando :other seja :values!',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente!',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente!',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente!',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes!',
    'same'                 => 'Os campos :attribute e :other devem ser iguais!',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ser :size!',
        'file'    => 'O campo :attribute deve ser :size kilobytes!',
        'string'  => 'O campo :attribute deve ser :size caracteres!',
        'array'   => 'O campo :attribute deve conter :size itens!',
    ],
    'string'               => 'O campo :attribute deve ser uma string!',
    'timezone'             => 'O campo :attribute deve ser uma zona válida!',
    'unique'               => 'Já existe um usuário com o email informado!',
    'uploaded'             => 'O campo :attribute falha no upload!',
    'url'                  => 'O campo :attribute deve ter uma URL válida!',

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
        'photo.required' => 'É obrigatório informar uma foto para o upload!',
        'photo.dimensions' => 'A foto deve possuir largura e a altura entre :min_widthpx(min.) e :max_widthpx(máx.)',
        'name' => [
            'unique' => 'O nome ":input" já está cadastrado e não pode ser repetido!',
        ]
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
        'name' => 'Nome',
        'class' => 'Classe',
        'image' => 'Foto',
        'description' => 'Descrição',
        'address' => 'Endereço',
        'title' => 'Título',
        'number' => 'Número',
        'zip_code' => 'Código postal',
        'email' => 'Email',
        'password' => 'Senha',
        'password_confirm' => 'Confirmar Senha',
        'is_admin' => 'É administrador ?',
        'status' => 'Status',
        'bcc' => 'Com cópia',
        'subject' => 'Assunto',
        'port' => 'Porta',
        'host' => 'Host',
        'phone' => 'Telefone',
        'phone2' => 'Telefone 2',
        'phone3' => 'Telefone 3',
        'business_hours' => 'Horário de funcionamento',
        'logotipo' => 'Logotipo',
        'brand_id' => 'Marca',
        'group_id' => 'Grupo',
        'photo' => 'Foto',


        'plate_num' => 'Placa',
        'plate' => 'Final da Placa',
        'obs' => 'Observação',
        'year' => 'Ano',
        'price' => 'Preço',
        'is_state' => 'Estado do Carro',
        'is_negotiable' => 'Tipo de Negociação',
        'is_visitable' => 'Pode ser visitado',
        'is_featured' => 'Em destaque',
        'is_top' => 'No topo',
        'is_offer' => 'Em oferta',
        'km' => 'Kilometragem',
        'ports' => 'Número de Portas',
        'url' => 'Endereço do Site',
        'seo_description' => 'Descrição breve (SEO)',
        'seo_keys' => 'Palavras-chave (SEO)',
        'version_id' => 'Versão',
        'brand_id' => 'Marca',
        'model_id' => 'Modelo',
        'color_id' => 'Cor',
        'gearbox_id' => 'Câmbio',
        'fuel_id' => 'Combustível',
        'documentation_id' => 'Documentação',
        'need_id' => 'Necessidade',
        'bodywork_id' => 'Carroceria'
    ],

];
