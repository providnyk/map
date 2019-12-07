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

    'accepted'             => ':attribute muss angenommen werden.',
    'active_url'           => ':attribute ist kein gültiges URL.',
    'after'                => ':attribute muss ein Datum nach dem :date sein.',
    'after_or_equal'       => ':attribute muss ein Datum nach oder am gleichen Tag wie :date sein.',
    'alpha'                => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => ':attribute darf nur Buchstaben, Zahlen und Striche enthalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array'                => ':attribute muss eine Anordnung sein.',
    'before'               => ':attribute muss ein Datum vor dem :date sein.',
    'before_or_equal'      => ':attribute muss ein Datum vor oder am gleichen Tag wie :date sein.',
    'between'              => [
        'numeric' => ':attribute muss zwischen :min und :max sein.',
        'file'    => ':attribute muss zwischen :min und :max Kilobytes sein.',
        'string'  => ':attribute muss zwischen :min und :max Zeichen sein.',
        'array'   => ':attribute muss zwischen :min und :max Elemente sein.',
    ],
    'boolean'              => ':attribute Feld muss wahr oder falsch sein.',
    'confirmed'            => ':attribute Bestätigung stimmt nicht überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute entspricht nicht dem Format :format.',
    'different'            => ':attribute und :other müssen anders sein.',
    'digits'               => ':attribute muss :digits Ziffern sein.',
    'digits_between'       => ':attribute muss zwischen :min und :max Ziffern sein.',
    'dimensions'           => ':attribute hat ungültige Bilddimensionen.',
    'distinct'             => ':attribute Feld hat ein doppelten Wert.',
    'email'                => ':attribute muss eine gültige E-Mail Adresse sein.',
    'exists'               => ':attribute Auswahl ist ungültig.',
    'file'                 => ':attribute muss eine Datei sein.',
    'filled'               => ':attribute Feld muss einen Wert haben.',
    'gt'                   => [
        'numeric' => ':attribute muss grösser sein als :value.',
        'file'    => ':attribute muss grösser sein als :value Kilobytes.',
        'string'  => ':attribute muss mehr sein als :value Zeichen.',
        'array'   => ':attribute muss mehr als :value Elemente haben.',
    ],
    'gte'                  => [
        'numeric' => ':attribute muss grösser oder gleich sein wie :value.',
        'file'    => ':attribute muss grösser oder gleich sein wie :value Kilobytes.',
        'string'  => ':attribute muss mehr oder gleich sein wie :value Zeichen.',
        'array'   => ':attribute muss :value oder mehr Elemente haben.',
    ],
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => ':attribute Auswahl ist ungültig.',
    'in_array'             => ':attribute Feld existiert nicht in :other.',
    'integer'              => ':attribute muss eine ganze Zahl sein.',
    'ip'                   => ':attribute muss eine gültige IP Adresse sein.',
    'ipv4'                 => ':attribute muss eine gültige IPv4 Adresse sein.',
    'ipv6'                 => ':attribute muss eine gültige IPv6 Adresse sein.',
    'json'                 => ':attribute muss eine gültige JSON Reihe sein.',
    'lt'                   => [
        'numeric' => ':attribute muss weniger sein als :value.',
        'file'    => ':attribute muss weniger sein als :value Kilobytes.',
        'string'  => ':attribute muss weniger sein als :value Zeichen.',
        'array'   => ':attribute muss weniger als :value Elemente haben.',
    ],
    'lte'                  => [
        'numeric' => ':attribute muss weniger oder gleich sein wie :value.',
        'file'    => ':attribute muss weniger oder gleich sein wie :value Kilobytes.',
        'string'  => ':attribute muss weniger oder gleich sein wie :value Zeichen.',
        'array'   => ':attribute darf nicht mehr als :value Elemente haben.',
    ],
    'max'                  => [
        'numeric' => ':attribute darf nicht grösser sein als :max.',
        'file'    => ':attribute darf nicht grösser sein als :max Kilobytes.',
        'string'  => ':attribute darf nicht mehr sein als :max Zeichen.',
        'array'   => ':attribute darf nicht mehr als :max Elemente haben.',
    ],
    'mimes'                => ':attribute muss eine Datei vom Typ: :values sein.',
    'mimetypes'            => ':attribute muss eine Datei vom Typ: :values sein.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min Kilobytes sein.',
        'string'  => ':attribute muss mindestens :min Zeichen sein.',
        'array'   => ':attribute muss mindestens :min Elemente haben.',
    ],
    'not_in'               => ':attribute Auswahl ist ungültig.',
    'not_regex'            => ':attribute Format ist ungültig.',
    'numeric'              => ':attribute muss eine Zahl sein.',
    'present'              => ':attribute Feld muss vorhanden sein.',
    'regex'                => ':attribute Format ist ungültig.',
    'required'             => ':attribute Feld ist erforderlich',
    'required_if'          => ':attribute Feld ist erforderlich wenn :other :value ist/sind.',
    'required_unless'      => ':attribute Feld ist erforderlich ausser wenn :other in :values ist/sind.',
    'required_with'        => ':attribute Feld ist erforderlich wenn :values vorhanden ist/sind.',
    'required_with_all'    => ':attribute Feld ist erforderlich wenn :values vorhanden ist/sind.',
    'required_without'     => ':attribute Feld ist erforderlich wenn :values nicht vorhanden ist/sind.',
    'required_without_all' => ':attribute Feld ist erforderlich wenn keine :values vorhanden ist/sind.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size sein.',
        'file'    => ':attribute muss :size Kilobytes sein.',
        'string'  => ':attribute muss :size Zeichen sein.',
        'array'   => ':attribute muss :size Elemente haben.',
    ],
    'string'               => ':attribute muss eine Reihe sein.',
    'timezone'             => ':attribute muss eine gültige Zeitzone sein.',
    'unique'               => ':attribute wird bereits verwendet.',
    'uploaded'             => ':attribute konnte nicht hochgeladen werden.',
    'url'                  => ':attribute ist ungültig.',

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

    'attributes' => [],

	'captcha'	=> 'This captcha :attribute is invalid',

];
