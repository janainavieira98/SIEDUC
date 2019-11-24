<?php

namespace App\Http\Requests\ClassroomDisciplineUser;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', $this->route('classroom_discipline_user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'classroom_id' => 'string|required|exists:classrooms,id',
            'discipline_id' => 'string|required|exists:disciplines,id',
            'user_id' => [
                'string',
                'required',
                function ($attribute, $value, $fail) {
                    $exists = User::institutionMember()->find($value);

                    if (!$exists) {
                        $fail(__("validation.attributes.$attribute") . ' é invalido');
                    }
                }
            ]
        ];
    }
}
