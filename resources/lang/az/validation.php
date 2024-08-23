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

    'accepted' => ':attribute qəbul edilməlidir.',
    'accepted_if' => ':other :value olduqda :attribute qəbul edilməlidir.',
    'active_url' => ':attribute düzgün URL deyil.',
    'after' => ':attribute :date tarixindən sonra olmalıdır.',
    'after_or_equal' => ':attribute :date tarixindən sonra və ya bərabər olmalıdır.',
    'alpha' => ':attribute yalnız hərflərdən ibarət olmalıdır.',
    'alpha_dash' => ':attribute yalnız hərflər, rəqəmlər, tire və alt xəttlərdən ibarət olmalıdır.',
    'alpha_num' => ':attribute yalnız hərflərdən və rəqəmlərdən ibarət olmalıdır.',
    'array' => ':attribute bir massiv olmalıdır.',
    'before' => ':attribute :date tarixindən əvvəl olmalıdır.',
    'before_or_equal' => ':attribute :date tarixindən əvvəl və ya bərabər olmalıdır.',
    'between' => [
        'numeric' => ':attribute :min ilə :max arasında olmalıdır.',
        'file' => ':attribute :min ilə :max kilobayt arasında olmalıdır.',
        'string' => ':attribute :min ilə :max simvol arasında olmalıdır.',
        'array' => ':attribute :min ilə :max maddə arasında olmalıdır.',
    ],
    'boolean' => ':attribute sahəsi doğru və ya yalan olmalıdır.',
    'confirmed' => ':attribute təsdiqi uyğun gəlmir.',
    'current_password' => 'Parol yanlışdır.',
    'date' => ':attribute düzgün tarix deyil.',
    'date_equals' => ':attribute :date tarixinə bərabər olmalıdır.',
    'date_format' => ':attribute :format formatına uyğun gəlmir.',
    'declined' => ':attribute qəbul edilməməlidir.',
    'declined_if' => ':other :value olduqda :attribute qəbul edilməməlidir.',
    'different' => ':attribute və :other fərqli olmalıdır.',
    'digits' => ':attribute :digits rəqəm olmalıdır.',
    'digits_between' => ':attribute :min ilə :max rəqəm arasında olmalıdır.',
    'dimensions' => ':attribute yanlızlıq ölçüləri yanlışdır.',
    'distinct' => ':attribute sahəsində təkrarlanan dəyər var.',
    'email' => ':attribute düzgün email ünvanı olmalıdır.',
    'ends_with' => ':attribute aşağıdakılardan biri ilə bitməlidir: :values.',
    'enum' => 'Seçilmiş :attribute yanlışdır.',
    'exists' => 'Seçilmiş :attribute yanlışdır.',
    'file' => ':attribute bir fayl olmalıdır.',
    'filled' => ':attribute sahəsi bir dəyər içərməlidir.',
    'gt' => [
        'numeric' => ':attribute :value-dən böyük olmalıdır.',
        'file' => ':attribute :value kilobaytdan böyük olmalıdır.',
        'string' => ':attribute :value simvoldan böyük olmalıdır.',
        'array' => ':attribute :value maddədən çox olmalıdır.',
    ],
    'gte' => [
        'numeric' => ':attribute :value-dən böyük və ya bərabər olmalıdır.',
        'file' => ':attribute :value kilobaytdan böyük və ya bərabər olmalıdır.',
        'string' => ':attribute :value simvoldan böyük və ya bərabər olmalıdır.',
        'array' => ':attribute :value maddə və ya daha çox olmalıdır.',
    ],
    'image' => ':attribute şəkil olmalıdır.',
    'in' => 'Seçilmiş :attribute yanlışdır.',
    'in_array' => ':attribute sahəsi :other-də mövcud deyil.',
    'integer' => ':attribute tam ədəd olmalıdır.',
    'ip' => ':attribute düzgün IP ünvanı olmalıdır.',
    'ipv4' => ':attribute düzgün IPv4 ünvanı olmalıdır.',
    'ipv6' => ':attribute düzgün IPv6 ünvanı olmalıdır.',
    'json' => ':attribute düzgün JSON sətri olmalıdır.',
    'lt' => [
        'numeric' => ':attribute :value-dən kiçik olmalıdır.',
        'file' => ':attribute :value kilobaytdan kiçik olmalıdır.',
        'string' => ':attribute :value simvoldan kiçik olmalıdır.',
        'array' => ':attribute :value maddədən az olmalıdır.',
    ],
    'lte' => [
        'numeric' => ':attribute :value-dən kiçik və ya bərabər olmalıdır.',
        'file' => ':attribute :value kilobaytdan kiçik və ya bərabər olmalıdır.',
        'string' => ':attribute :value simvoldan kiçik və ya bərabər olmalıdır.',
        'array' => ':attribute :value maddədən çox olmamalıdır.',
    ],
    'mac_address' => ':attribute düzgün MAC ünvanı olmalıdır.',
    'max' => [
        'numeric' => ':attribute :max-dən böyük olmamalıdır.',
        'file' => ':attribute :max kilobaytdan böyük olmamalıdır.',
        'string' => ':attribute :max simvoldan böyük olmamalıdır.',
        'array' => ':attribute :max maddədən çox olmamalıdır.',
    ],
    'mimes' => ':attribute növü belə olmalıdır: :values.',
    'mimetypes' => ':attribute növü belə olmalıdır: :values.',
    'min' => [
        'numeric' => ':attribute ən azı :min olmalıdır.',
        'file' => ':attribute ən azı :min kilobayt olmalıdır.',
        'string' => ':attribute ən azı :min simvol olmalıdır.',
        'array' => ':attribute ən azı :min maddə olmalıdır.',
    ],
    'multiple_of' => ':attribute :value-nin çoxu olmalıdır.',
    'not_in' => 'Seçilmiş :attribute yanlışdır.',
    'not_regex' => ':attribute formatı yanlışdır.',
    'numeric' => ':attribute rəqəm olmalıdır.',
    'password' => 'Parol yanlışdır.',
    'present' => ':attribute sahəsi mövcud olmalıdır.',
    'prohibited' => ':attribute sahəsi qadağandır.',
    'prohibited_if' => ':other :value olduqda :attribute sahəsi qadağandır.',
    'prohibited_unless' => ':other :values-də olmadıqda :attribute sahəsi qadağandır.',
    'prohibits' => ':attribute sahəsi :other-nin mövcud olmasını qadağan edir.',
    'regex' => ':attribute formatı yanlışdır.',
    'required' => ':attribute sahəsi tələb olunur.',
    'required_array_keys' => ':attribute sahəsi aşağıdakılara ehtiyac duyur: :values.',
    'required_if' => ':other :value olduqda :attribute sahəsi tələb olunur.',
    'required_unless' => ':other :values-də olmadıqda :attribute sahəsi tələb olunur.',
    'required_with' => ':values mövcud olduqda :attribute sahəsi tələb olunur.',
    'required_with_all' => ':values mövcud olduqda :attribute sahəsi tələb olunur.',
    'required_without' => ':values mövcud olmadıqda :attribute sahəsi tələb olunur.',
    'required_without_all' => ':values-dən heç biri mövcud olmadıqda :attribute sahəsi tələb olunur.',
    'same' => ':attribute və :other eyni olmalıdır.',
    'size' => [
        'numeric' => ':attribute :size olmalıdır.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'string' => ':attribute :size simvol olmalıdır.',
        'array' => ':attribute :size maddə içərməlidir.',
    ],
    'starts_with' => ':attribute aşağıdakılardan biri ilə başlamalıdır: :values.',
    'string' => ':attribute sətr olmalıdır.',
    'timezone' => ':attribute düzgün bir zaman zonası olmalıdır.',
    'unique' => ':attribute artıq mövcuddur.',
    'uploaded' => ':attribute yüklənmədə uğursuz oldu.',
    'url' => ':attribute düzgün bir URL olmalıdır.',
    'uuid' => ':attribute düzgün bir UUID olmalıdır.',

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
            'rule-name' => 'xüsusi mesaj',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
