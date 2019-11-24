<?php

namespace App\Http\Requests\ClassroomDisciplineUser;

use App\ClassroomDisciplineUser;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', ClassroomDisciplineUser::class);
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
            ],
            'hour' => [
                'required',
                'string',
                'regex:/\d{2}\:\d{2}/',
                function($attribute, $value, $fail) {
                    $exists = ClassroomDisciplineUser::where('hour', $value)->where('user_id', $this->request->get('user_id'))->exists();

                    if ($exists) {
                        $fail('já existe uma aula neste horario para este professor');
                    }
                },
                function($attribute, $value, $fail) {
                    $exists = ClassroomDisciplineUser::where('hour', $value)->where('classroom_id', $this->request->get('classroom_id'))->exists();

                    if ($exists) {
                        $fail('já existe uma aula neste horario para esta classe');
                    }
                },
            ],
            'weekday_slug' => 'required|string|exists:weekdays,slug'
        ];
    }
}
