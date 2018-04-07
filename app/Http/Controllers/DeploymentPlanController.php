<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeploymentPlanRequest;
use App\Models\DeploymentPlan;

class DeploymentPlanController extends Controller
{
    /**
     * View for displaying all deployment plans
     */
    public function view()
    {
        return view('pages.deployment_plans.view');
    }

    /**
     * View for creating a deployment plan
     */
    public function create()
    {
        return view('pages.deployment_plans.create');
    }

    /**
     * Store new deployment plan
     */
    public function store(DeploymentPlanRequest $request)
    {
        $plan = DeploymentPlan::create([
            'name' => $request->get('name'),
            'web_server_id' => $request->get('web_server_id'),
            'project_id' => $request->get('project_id'),
            'project_branch' => $request->get('project_branch'),
            'update_seconds' => $request->get('update_seconds'),
            'storage_path' => $request->get('storage_path'),
        ]);

        return redirect()->back()->withInput()->with(['message' => 'Successfully created deployment plan \'' . $plan->name . '\'']);
    }

    /**
     * View for updating existing DeploymentPlan $plan
     */
    public function edit(DeploymentPlan $plan)
    {
        return view('pages.deployment_plans.edit', compact('plan'));
    }

    /**
     * Update existing DeploymentPlan $plan
     */
    public function update(DeploymentPlanRequest $request, DeploymentPlan $plan)
    {
        $plan->update([
            'name' => $request->get('name'),
            'web_server_id' => $request->get('web_server_id'),
            'project_id' => $request->get('project_id'),
            'project_branch' => $request->get('project_branch'),
            'update_seconds' => $request->get('update_seconds'),
            'storage_path' => $request->get('storage_path'),
        ]);

        return redirect()->back()->withInput()->with(['message' => 'Successfully updated deployment plan \'' . $plan->name . '\'']);
    }

    /**
     * Delete existing DeploymentPlan $plan
     */
    public function delete(DeploymentPlan $plan)
    {
        $plan->delete();

        return redirect()->back()->with(['message' => 'Successfully deleted deployment plan']);
    }

}
