<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User\User;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'language' => ['required','string',Rule::in(User::$langs)],
            'first_name' => ['required','string','min:4','max:255'],
            'last_name' => ['required','string','min:4','max:255'],
            'email' => ['required','string','email',User::table('unique:{t},email')],
            'phone' => ['sometimes', 'nullable', 'string', 'min:8', 'max:255'],
            'average_salary' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:999999.99'],
            'position' => ['required','string',Rule::in(User::$positions)],
            'address' => ['required','string','min:4','max:65535'],
            'country' => ['required','string','min:4','max:255'],
            'postal_code' => ['required','string','min:4','max:255'],
            'city' => ['required','string','min:4','max:255'],
            'house_number' => ['required','string','min:1','max:255'],
            'apartment_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            'is_mailing_address_different' => ['sometimes', 'nullable', 'boolean'],
            'mailing_address' => ['sometimes', 'nullable', 'string', 'min:4', 'max:65535'],
            'mailing_country' => ['sometimes', 'nullable', 'string', 'min:4', 'max:255'],
            'mailing_postal_code' => ['sometimes', 'nullable', 'string', 'min:4', 'max:255'],
            'mailing_city' => ['sometimes', 'nullable', 'string', 'min:4', 'max:255'],
            'mailing_house_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            'mailing_apartment_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            'password' => ['required','string','min:'. User::$password_length],
            'password_confirmation' => ['required','string','same:password','min:'. User::$password_length],
        ];

        if($this->get('is_mailing_address_different', false)):
            $mailingRules = [
                'mailing_address' => ['required', 'string', 'min:4', 'max:65535'],
                'mailing_country' => ['required', 'string', 'min:4', 'max:255'],
                'mailing_postal_code' => ['required', 'string', 'min:4', 'max:255'],
                'mailing_city' => ['required', 'string', 'min:4', 'max:255'],
                'mailing_house_number' => ['required', 'string', 'min:1', 'max:255'],
                'mailing_apartment_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            ];
    
            $rules = array_merge($rules, $mailingRules);
        endif;

        return $rules;
    }
    
    public function insert(): User
    {
        return User::create([
            "language" => $this->language,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "email_verified_at" => now(),
            "phone" => $this->get('phone', null),
            "average_salary" => $this->get('average_salary', null),
            "position" => $this->position,
            "address" => $this->address,
            "country" => $this->country,
            "postal_code" => $this->postal_code,
            "city" => $this->city,
            "house_number" => $this->house_number,
            "apartment_number" => $this->apartment_number,
            "is_mailing_address_different" => $this->get('is_mailing_address_different', false),
            "mailing_address" => $this->get('mailing_address', null),
            "mailing_country" => $this->get('mailing_country', null),
            "mailing_postal_code" => $this->get('mailing_postal_code', null),
            "mailing_city" => $this->get('mailing_city', null),
            "mailing_house_number" => $this->get('mailing_house_number', null),
            "mailing_apartment_number" => $this->get('mailing_apartment_number', null),
            "password" => $this->password,
        ])->refresh();
    }
}