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
            'web_server_id' => 'required',
            'project_id' => 'required',
            'project_branch' => 'required',
            'storage_path' => '',
        ];
    }
}
