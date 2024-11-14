<?php

namespace App\Http\Requests\ObjectiveQuestion;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjectiveQuestionRequest extends FormRequest
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
            'lesson_id'         => 'required|exists:lessons,id',
            'status'            => 'required|in:APPROVED,PENDING,DISAPPROVED',
            'question'          => 'required',
            'correct_answer'    => 'required',
        ];
    }
}
