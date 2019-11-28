<?php

namespace App\Http\Requests\Grade;

use App\Grade;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $record = Grade::whereHas('classroom', function ($query) {
            $query->where('classrooms.id', $this->route('classroom')->id)
                ->whereHas('disciplines', function ($query) {
                    $query->where('disciplines.id', $this->route('discipline')->id);
                });
        })->where('user_id', $this->route('user')->id)
            ->first();

        if (!$record) {
            return false;
        }

        return auth()->user()->can('update', $record);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
