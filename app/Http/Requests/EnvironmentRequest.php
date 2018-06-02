<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnvironmentRequest extends FormRequest
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
            'ip_address' => 'required|ip',
            'ssh_port' => 'required|numeric',
            'authentication_type' => 'required',
            'ssh_password' => 'required_if:authentication_type,password',
            'private_key' => 'required_if:authentication_type,private_key|file',
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
            'title.required' => 'A title is required',
            'ip_address.required' => 'An IP address is required',
            'ip_address.ip' => 'Invalid IP address',
            'ssh_port.required' => 'A SSH port is required',
            'ssh_port.numeric' => 'Invalid SSH port',
            'authentication_type.required' => 'An authentication type is required',
            'ssh_password.required' => 'An SSH password is required',
            'private_key.required' => 'A private key file is required',
        ];
    }
}
