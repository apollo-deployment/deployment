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
            'name' => 'required',
            'environment_id' => 'required',
            'repository_id' => 'required',
            'repository_branch' => 'required',
            'is_automatic' => 'required',
            'remote_path' => 'required',
        ];
    }
}
