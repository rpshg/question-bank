<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'program_id'        => 'required|exists:programs,id',
            'level_id'          => 'required|exists:levels,id',
            'name'              => 'required|min:3|max:255',
            'slug'              => 'required|min:3|max:255|unique:levels',
            'status'            => 'required|in:APPROVED,PENDING,DISAPPROVED',
        ];
    }
}
