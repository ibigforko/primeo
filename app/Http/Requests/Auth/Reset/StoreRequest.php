<?php

namespace App\Http\Requests\Auth\Reset;

use App\Http\Requests\ApiFormRequest;
use App\Models\User\ResettingToken;
use Illuminate\Validation\Rule;
use App\Models\User\User;

class StoreRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique(ResettingToken::table(), 'user_email')
                    ->where(function ($query) {
                        $query->where('active', 1)
                            ->where('created_at', '>', \Carbon\Carbon::now()->subHours(4)->toDateTimeString());
                    }),
                User::table('exists:{t}, email')
            ]
        ];
    }
}