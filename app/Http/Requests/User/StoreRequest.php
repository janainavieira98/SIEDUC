<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'cpf' => [
                'required',
                'string',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
                'unique:users,cpf'
            ],
            'rg' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{3}\.\d{3}\-\d{1}$/',
                'unique:users,rg'
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
