<?php

namespace App\Http\Requests\Classroom;

use Illuminate\Foundation\Http\FormRequest;

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
            'grade' => 'required|integer',
            'description' => 'required|string|max:255',
            'period_slug' => 'required|string|exists:periods,slug',
            'start_hour' => [
                'required',
                'string',
                'regex:/^\d{2}\:\d{2}$/'
            ],
            'end_hour' => [
                'required',
                'string',
                'regex:/^\d{2}\:\d{2}$/'
            ],
            'year' => [
                'required',
                'integer',
                'regex:/^\d{4}$/'
            ],
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer'
        ];
    }
}
