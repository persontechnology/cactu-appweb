<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRq extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|unique:users,email',
            'password'=>'required|string|max:255',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            "roles"    => "required|array",
            "roles.*"  => "required|exists:roles,id",
            'provincia'=>'required'
        ];
    }
    
}
