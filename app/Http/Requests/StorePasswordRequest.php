<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
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
            'title' => 'required|string|max:50|unique:passwords',
            'group_id' => 'nullable|integer',
            'category_id' => 'required|integer',
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password',
            'status' => 'required|in:Active,Inactive', 
        ];
    }
}
