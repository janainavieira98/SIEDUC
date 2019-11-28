<?php

namespace App\Http\Requests\Grade;

class StoreRequest extends CreateRequest
{
    public function authorize()
    {
        return parent::authorize()
            && !is_null($this->route('classroom'))
            && !is_null($this->route('discipline'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grade1' => 'nullable|numeric',
            'absences1' => 'nullable|integer',
            'grade2' => 'nullable|numeric',
            'absences2' => 'nullable|integer',
            'grade3' => 'nullable|numeric',
            'absences3' => 'nullable|integer',
            'grade4' => 'nullable|numeric',
            'absences4' => 'nullable|integer',
            'user_id' => 'required|integer|exists:users,id',
            'approved' => 'nullable|boolean'
        ];
    }
}
