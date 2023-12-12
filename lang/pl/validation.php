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

    'accepted' => ':attribute musi zostać zaakceptowany.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi być datą późniejszą niż :date.',
    'after_or_equal' => ':attribute musi być datą późniejszą lub równą :date.',
    'alpha' => ':attribute może zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać tylko litery, cyfry i podkreślenia.',
    'alpha_num' => ':attribute może zawierać tylko litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'before' => ':attribute musi być datą wcześniejszą niż :date.',
    'before_or_equal' => ':attribute musi być datą wcześniejszą lub równą :date.',
    'between' => [
        'numeric' => ':attribute musi być wartością pomiędzy :min i :max.',
        'file' => ':attribute musi mieć pomiędzy :min a :max kilobajtów.',
        'string' => ':attribute musi mieć pomiędzy :min a :max znaków.',
        'array' => ':attribute musi mieć pomiędzy :min a :max pozycji.',
    ],
    'boolean' => 'Pole :attribute musi być true lub false.',
    'confirmed' => 'Potwierdzenie :attribute nie pasuje.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_equals' => ':attribute musi być datą równą :date.',
    'date_format' => ':attribute nie zgadza się z formatem :format.',
    'different' => ':attribute i :other muszą być różne.',
    'digits' => 'Pole :attribute musi mieć :digits cyfr.',
    'digits_between' => ':attribute musi mieć pomiędzy :min a :max cyfr.',
    'dimensions' => ':attribute ma nieprawidłowe wymiary obrazu.',
    'distinct' => ':attribute pole ma zduplikowaną wartość.',
    'email' => ':attribute musi być poprawnym adresem e-mail.',
    'exists' => 'Wybrany :attribute jest nieprawidłowy.',
    'file' => ':attribute musi być plikiem.',
    'filled' => ':attribute pole musi mieć wartość.',
    'gt' => [
        'numeric' => ':attribute musi być większy niż :value.',
        'file' => ':attribute musi być większy niż :value kilobajtów.',
        'string' => ':attribute musi mieć więcej niż :value znaków.',
        'array' => ':attribute musi być większa niż :value pozycji.',
    ],
    'gte' => [
        'numeric' => ':attribute musi być większy lub równy :value.',
        'file' => ':attribute musi mieć tyle samo lub więcej :value kilobajtów.',
        'string' => ':attribute musi mieć tyle samo lub więcej :value znaków.',
        'array' => ':attribute musi mieć :value pozycji albo więcej.',
    ],
    'image' => ':attribute musi być obrazkiem.',
    'in' => 'Wybrany :attribute jest nieprawidłowy.',
    'in_array' => ':attribute pole nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą.',
    'ip' => ':attribute musi być poprawnym adresem IP.',
    'ipv4' => ':attribute musi być poprawnym adresem IPv4 .',
    'ipv6' => ':attribute musi być poprawnym adresem IPv6 .',
    'json' => ':attribute musi być poprawnym wierszem JSON .',
    'lt' => [
        'numeric' => ':attribute musi być mniejszy niż :value.',
        'file' => ':attribute musi mieć mniej niż :value kilobajtów.',
        'string' => ':attribute musi mieć mniej niż :value znaków.',
        'array' => ':attribute musi mieć mniej niż :value pozycji.',
    ],
    'lte' => [
        'numeric' => ':attribute musi być mniejszy lub równy :value.',
        'file' => ':attribute musi mieć tyle samo lub mniej :value kilobajtów.',
        'string' => ':attribute musi mieć tyle samo lub mniej :value znaków.',
        'array' => ':attribute nie może mieć więcej niż :value pozycji.',
    ],
    'max' => [
        'numeric' => ':attribute nie może być większy niż :max.',
        'file' => ':attribute nie może mieć więcej niż :max kilobajtów.',
        'string' => ':attribute nie może mieć więcej niż :max znaków.',
        'array' => ':attribute nie może mieć więcej niż :max pozycji.',
    ],
    'mimes' => 'The :attribute musi być plikiem typu: :values.',
    'mimetypes' => 'The :attribute musi być plikiem typu: :values.',
    'min' => [
        'numeric' => ':attribute musi mieć co najmniej :min.',
        'file' => ':attribute musi mieć co najmniej :min kilobajtów.',
        'string' => ':attribute musi mieć co najmniej :min znaków.',
        'array' => ':attribute musi mieć co najmniej :min pozycji.',
    ],
    'not_in' => 'Wybrany :attribute jest nieprawidłow.',
    'not_regex' => 'Format :attribute jest nieprawidłowy.',
    'numeric' => ':attribute musi być liczbą.',
    'present' => 'Pole :attribute nie może być puste.',
    'regex' => 'Format :attribute jest nieprawidłowy.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_if' => 'Pole :attribute jest wymagane, gdy :other ma wartość :value.',
    'required_unless' => 'Pole :attribute  jest wymagane chyba że :other jest w :values.',
    'required_with' => 'Pole :attribute jest wymagane, gdy :values są zdefiniowane.',
    'required_with_all' => 'Pole :attribute jest wymagane, gdy :values są zdefiniowane.',
    'required_without' => 'Pole :attribute jest wymagane, gdy :values nie są zdefiniowane.',
    'required_without_all' => 'Pole :attribute jest wymagane, gdy żadne z :values nie są zdefiniowane.',
    'same' => ':attribute i :other muszą być takie same.',
    'size' => [
        'numeric' => ':attribute musi być :size.',
        'file' => ':attribute musi mieć :size kilobajtów.',
        'string' => ':attribute musi mieć :size znaków.',
        'array' => ':attribute musi zawierać :size pozycji.',
    ],
    'starts_with' => ':attribute musi zaczynać się od jednego z: :values',
    'string' => ':attribute musi być wierszem.',
    'timezone' => ':attribute musi być prawidłową strefą czasową.',
    'unique' => ':attribute jest już zajęty.',
    'uploaded' => ':attribute nie udało się przesłać.',
    'url' => 'Format :attribute jest nieprawidłowy.',
    'uuid' => ':attribute musi być ważny UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "first_name" => "Imię",
        "last_name" => "Nazwisko",
        "email" => "E-mail",
        "phone_number" => "Numer telefonu",
        "address" => "Adres",
        "role" => "Rola",
        "country" => "Kraj",
        "language" => "Język",
        "current_password" => "Aktualne hasło",
        "password" => "Hasło",
        "password_confirmation" => "Potwierdzenie Hasła",
        "photo" => "Zdjęcie",
        "gender" => "Płeć",
    ],

];
