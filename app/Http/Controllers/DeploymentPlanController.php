<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeploymentPlanRequest;
use App\Models\DeploymentPlan;
use Illuminate\Http\Request;

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
            'title' => $request->get('title'),
            'environment_id' => $request->get('environment_id'),
            'repository_id' => $request->get('repository_id'),
            'repository_branch' => $request->get('repository_branch'),
            'is_automatic' => true, // CHANGE
            'remote_path' => $request->get('remote_path'),
        ]);

        return redirect()->route('view.deployment-plans')->with(['message' => "Successfully created deployment plan '{$plan->title}'"]);
    }

    /**
     * Store new deployment plan
     */
    public function logstore(Request $request)
    {
        \Log::info($request->all());
//        $plan = DeploymentPlan::create([
//            'title' => $request->get('title'),
//            'environment_id' => $request->get('environment_id'),
//            'repository_id' => $request->get('repository_id'),
//            'repository_branch' => $request->get('repository_branch'),
//            'is_automatic' => true, // CHANGE
//            'remote_path' => $request->get('remote_path'),
//        ]);

        return json_encode('something in it');
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
            'remote_path' => $request->get('remote_path'),
        ]);

        return redirect()->route('view.deployment-plans')->with(['message' => "Successfully updated deployment plan \'{$plan->title}\'"]);
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
