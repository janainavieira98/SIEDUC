<?php

namespace App\Http\Requests\Grade;

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
            'grade1' => 'required|numeric',
            'absences1' => 'required|integer',
            'grade2' => 'required|numeric',
            'absences2' => 'required|integer',
            'grade3' => 'required|numeric',
            'absences3' => 'required|integer',
            'grade4' => 'required|numeric',
            'absences4' => 'required|integer',
            'classroom_id' => 'required|integer|exists:classrooms,id',
            'discipline_id' => 'required|integer|exists:disciplines,id',
            'approved' => 'nullable|boolean'
        ];
    }
}
