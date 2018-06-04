<?php

namespace App\Jobs;

use App\Events\BuildEvent;
use App\Models\DeploymentPlan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Build implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $deployment_plan;

    /**
     * Create a new job instance
     */
    public function __construct(DeploymentPlan $_deployment_plan)
    {
        $this->deployment_plan = $_deployment_plan;
    }

    /**
     * Execute the job
     */
    public function handle()
    {
        event(new BuildEvent($this->deployment_plan));
    }
}
