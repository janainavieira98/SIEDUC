<?php


namespace App\Http\Requests\ClassroomDisciplineUser;


use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('delete', $this->route('classroom_discipline_user'));
    }

    public function rules()
    {
        return [];
    }
}
