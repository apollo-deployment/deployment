<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeploymentPlanRequest;
use App\Models\DeploymentPlan;
use Illuminate\Support\Facades\Auth;

class DeploymentPlanController extends Controller
{
    /**
     * View for displaying all deployment plans
     */
    public function view()
    {
        $repositories = Auth::user()->organization->repositories();
        $repositories->load('deploymentPlans');

        return view('pages.deployment_plans.view', compact('repositories'));
    }

    /**
     * View for creating a deployment plan
     */
    public function create()
    {
        return view('pages.deployment_plans.create');
    }

    /**
     * View for updating existing DeploymentPlan $plan
     */
    public function edit(DeploymentPlan $plan)
    {
        return view('pages.deployment_plans.edit', compact('plan'));
    }

    /**
     * Store new deployment plan
     */
    public function store(DeploymentPlanRequest $request)
    {
        $plan = DeploymentPlan::create([
            'organization_id' => Auth::user()->organization_id,
            'title' => $request->get('title'),
            'environment_id' => $request->get('environment_id'),
            'repository_id' => $request->get('repository_id'),
            'repository_branch' => $request->get('repository_branch'),
            'is_automatic' => true, // CHANGE
            'commands' => str_replace('\r\n','<br>',$request->get('commands'))
        ]);

        return redirect()->route('view.deployment-plans')->with(['message' => "Successfully created deployment plan '{$plan->title}'"]);
    }

    /**
     * Update existing DeploymentPlan $plan
     */
    public function update(DeploymentPlanRequest $request, DeploymentPlan $plan)
    {
        $plan->update([
            'title' => $request->get('title'),
            'environment_id' => $request->get('environment_id'),
            'repository_id' => $request->get('repository_id'),
            'repository_branch' => $request->get('repository_branch'),
            'is_automatic' => true, // CHANGE
            'commands' => str_replace('\r\n','<br>',$request->get('commands'))
        ]);

        return redirect()->route('view.deployment-plans')->with(['message' => "Successfully updated deployment plan '{$plan->title}'"]);
    }

    /**
     * Delete existing DeploymentPlan $plan
     */
    public function delete(DeploymentPlan $plan)
    {
        $plan->delete();

        return redirect()->route('view.deployment-plans')->with(['message' => 'Successfully deleted deployment plan']);
    }
}
