<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeploymentPlanRequest extends FormRequest
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
            'environment_id' => 'required|numeric',
            'repository_id' => 'required|numeric',
            'repository_branch' => 'required',
            'commands' => 'regex:/deploy;/'
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
            'environment_id.required' => 'An environment is required',
            'repository_id.required' => 'A repository is required',
            'repository_branch' => 'A repository branch is required',
            'commands.regex' => 'Commands must contain command "deploy;" for deployment'
        ];
    }
}
