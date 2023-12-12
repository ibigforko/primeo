<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User\User;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'language' => ['sometimes','nullable','string',Rule::in(User::$langs)],
            'first_name' => ['sometimes','nullable','string','min:4','max:255'],
            'last_name' => ['sometimes','nullable','string','min:4','max:255'],
            'email' => ['sometimes','nullable','string','email',User::table("unique:{t},email,{$this->user->id}")],
            'phone' => ['sometimes', 'nullable', 'string', 'min:8', 'max:255'],
            'average_salary' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:999999.99'],
            'position' => ['sometimes','nullable','string',Rule::in(User::$positions)],
            'address' => ['sometimes','nullable','string','min:4','max:65535'],
            'country' => ['sometimes','nullable','string','min:4','max:255'],
            'postal_code' => ['sometimes','nullable','string','min:4','max:255'],
            'city' => ['sometimes','nullable','string','min:4','max:255'],
            'house_number' => ['sometimes','nullable','string','min:1','max:255'],
            'apartment_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            'is_mailing_address_different' => ['sometimes', 'nullable', 'boolean'],
            'mailing_address' => ['sometimes', 'nullable', 'string', 'min:4', 'max:65535'],
            'mailing_country' => ['sometimes', 'nullable', 'string', 'min:4', 'max:255'],
            'mailing_postal_code' => ['sometimes', 'nullable', 'string', 'min:4', 'max:255'],
            'mailing_city' => ['sometimes', 'nullable', 'string', 'min:4', 'max:255'],
            'mailing_house_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            'mailing_apartment_number' => ['sometimes', 'nullable', 'string', 'min:1', 'max:255'],
            'password' => ['sometimes','nullable','string','min:'. User::$password_length],
            'password_confirmation' => ['sometimes','nullable','string','same:password','min:'. User::$password_length],
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
    
    public function actualise():? User
    {
        return $this->user->update([
            "language" => $this->get('language', $this->user->language),
            "first_name" => $this->get('first_name', $this->user->first_name),
            "last_name" => $this->get('last_name', $this->user->last_name),
            "email" => $this->get('email', $this->user->email),
            "phone" => $this->get('phone', $this->user->phone),
            "average_salary" => $this->get('average_salary', $this->user->average_salary),
            "position" => $this->get('position', $this->user->position),
            "address" => $this->get('address', $this->user->address),
            "country" => $this->get('country', $this->user->country),
            "postal_code" => $this->get('postal_code', $this->user->postal_code),
            "city" => $this->get('city', $this->user->city),
            "house_number" => $this->get('house_number', $this->user->house_number),
            "apartment_number" => $this->get('apartment_number', $this->user->apartment_number),
            "is_mailing_address_different" => $this->get('is_mailing_address_different', $this->user->is_mailing_address_different),
            "mailing_address" => $this->get('mailing_address', $this->user->mailing_address),
            "mailing_country" => $this->get('mailing_country', $this->user->mailing_country),
            "mailing_postal_code" => $this->get('mailing_postal_code', $this->user->mailing_postal_code),
            "mailing_city" => $this->get('mailing_city', $this->user->mailing_city),
            "mailing_house_number" => $this->get('mailing_house_number', $this->user->mailing_house_number),
            "mailing_apartment_number" => $this->get('mailing_apartment_number', $this->user->mailing_apartment_number),
            "password" => $this->get('password', null),
        ]) ? $this->user->refresh() : null;
    }
}