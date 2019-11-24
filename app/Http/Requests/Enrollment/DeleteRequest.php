<?php


namespace App\Http\Requests\Enrollment;


use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('delete', $this->route('enrollment'));
    }

    public function rules()
    {
        return [];
    }
}
