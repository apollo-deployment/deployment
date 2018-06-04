<?php

namespace App\Events;

use App\Models\DeploymentPlan;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BuildEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deployment_plan;

    /**
     * Create a new event instance
     */
    public function __construct(DeploymentPlan $_deployment_plan)
    {
        $this->deployment_plan = $_deployment_plan;
    }

    /**
     * Get the channels the event should broadcast on
     */
    public function broadcastOn()
    {
        return ["deployment-channel." . $this->deployment_plan->organization->id];
    }
}
