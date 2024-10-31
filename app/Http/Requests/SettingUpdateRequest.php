<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'title' => 'required',
            'meta_description' => 'required',
            'url' => ['required', 'url'],
            'name' => 'required',
            'phone' => ['required', 'digits:10'],
            'email' => ['required', 'email'],
            'address' => 'required',
            'maps' => 'required',
            'analytics' => 'required',
            'facebook' => ['nullable'],
            'instagram' => ['nullable'],
            'twitter' => ['nullable'],
        ];
    }

}
