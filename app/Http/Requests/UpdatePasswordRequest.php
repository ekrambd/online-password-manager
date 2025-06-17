<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'title' => 'required|string|max:50|unique:passwords,title,' . $this->password->id,
            'group_id' => 'nullable|integer',
            'category_id' => 'required|integer',
            'password' => 'nullable|string',
            'confirm_password' => 'nullable|string|same:password',
            'status' => 'required|in:Active,Inactive', 
        ]; 
    }
}
