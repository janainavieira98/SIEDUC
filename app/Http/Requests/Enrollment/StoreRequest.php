<?php

namespace App\Http\Requests\Enrollment;

use App\Classroom;
use App\Enrollment;

class StoreRequest extends CreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $exists = Enrollment::where('user_id', $value)
                        ->where('classroom_id', $this->request->get('classroom_id'))
                        ->exists();

                    if ($exists) {
                        $fail('este usuário já está matriculado nessa classe');
                    }
                }
            ],
            'classroom_id' => [
                'required',
                'integer',
                'exists:classrooms,id',
                function($attribute, $value, $fail) {
                    $classroom = Classroom::find($value);

                    if (!$classroom) {
                        $fail('está classe não foi encontrada');
                    }

                    $maxUsers = $classroom->max_users;
                    $enrolledUsers = Enrollment::where('classroom_id', $value)->count();

                    if ($enrolledUsers+1 > $maxUsers) {
                        $fail('não há mais vagas nesta classe');
                    }
                }
            ],
            'enrollment_type_slug' => [
                'required',
                'string',
                'exists:enrollment_types,slug'
            ],
            'roll_id' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $exists = Enrollment::where('classroom_id', $this->request->get('classroom_id'))->where('roll_id', $value)->exists();

                    if ($exists) {
                        $fail('este número da chamada já esta sendo utilizado');
                    }
                }
            ],
            'date' => 'required|date'
        ];
    }
}
