<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
        $admin_id = request()->segment(3);

        $rules = [
                'name'  => 'required|min:3',
                'email' => 'required|email|unique:admins,email,' . $admin_id . ',id',
                // 'status' => 'required|in:Active,Inactive'
            ];

        if(request()->has('password_change')){
            $rules['password'] = 'required|min:6|confirmed';
        }
        
        return $rules;
        
    }
}
