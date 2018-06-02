<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterOrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'An organization title is required',
            'name.required' => 'Your name is required',
            'email.required' => 'Your email is required',
            'email.email' => 'Invalid email',
            'password.required' => 'A password is required',
            'password.min' => 'Password must be at least 8 characters',
        ];
    }
}
