<?php

namespace App\Http\Requests\Level;

use Illuminate\Foundation\Http\FormRequest;

class StoreLevelRequest extends FormRequest
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
                'name'              => 'required|min:3|max:255',
                'slug'              => 'required|min:3|max:255|unique:levels',
                'program_id'        => 'required|exists:programs,id',
                'avatar'            => 'nullable|file|mimes:jpg,jpeg,png|max:500',
                'status'            => 'required|in:APPROVED,PENDING,DISAPPROVED',
        ];
    }
}
