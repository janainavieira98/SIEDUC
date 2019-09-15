<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends EditRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignoreModel($this->route('user'), 'id')
            ],
            'cpf' => [
                'required',
                'string',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
                Rule::unique('users', 'cpf')->ignoreModel($this->route('user'), 'id'),
            ],
            'rg' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{3}\.\d{3}\-\d{1}$/',
                Rule::unique('users', 'rg')->ignoreModel($this->route('user'), 'id'),
            ],
            'mobile_number' => [
                'required',
                'string',
                'regex:/^\(\d{2}\)\s?\d{4,5}\-\d{4}$/'
            ],
            'home_number' => [
                'required',
                'string',
                'regex:/\(\d{2}\)\s?\d{4}\-\d{4}/'
            ],
            'cep' => [
                'required',
                'string',
                'regex:/\d{5}\-\d{3}/'
            ],
            'address' => 'required|string',
            'city' => 'required|string',
            'neighborhood' => 'required|string',
            'role' => 'required|exists:roles,id',
            'birthday' => 'required|date'
        ];
    }
}
