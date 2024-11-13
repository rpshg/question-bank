<?php

namespace App\Http\Requests\Level;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLevelRequest extends FormRequest
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
        $levelId = request()->segment(3);
        return [
            'name'              => 'required|min:3|max:255',
            'slug'              => 'required|min:3|max:255|unique:levels,slug,'.$levelId,
            'program_id'        => 'required|exists:programs,id',
            'avatar'            => 'nullable|file|mimes:jpg,jpeg,png|max:500',
            'status'            => 'required|in:APPROVED,PENDING,DISAPPROVED',
        ];
    }
}
