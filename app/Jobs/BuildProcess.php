<?php

namespace App\Jobs;

use App\Events\BuildEvent;
use App\Models\Build;
use App\Models\DeploymentPlan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class BuildProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Deployment plan ready for building
     */
    public $deployment_plan;

    /**
     * @var $automatic_deploy : Whether or not to deploy or just notify org
     */
    public $automatic_deploy;

    /**
     * Create a new job instance
     */
    public function __construct(DeploymentPlan $_deployment_plan, $_automatic_deploy)
    {
        $this->deployment_plan = $_deployment_plan;
        $this->automatic_deploy = $_automatic_deploy;
    }

    /**
     * Execute the job
     */
    public function handle()
    {
        $environment = $this->deployment_plan->environment;

        // Notify org that plan is ready for deployment
        if (!$this->automatic_deploy) {
            $this->deployment_plan->update([
                'status' => 'ready'
            ]);

            event(new BuildEvent($this->deployment_plan));

        // Start build process
        } else {
            $this->deployment_plan->update([
                'status' => 'in_progress'
            ]);
            $build = Build::create([
                'deployment_plan_id' => $this->deployment_plan->id,
                'status' => 'in_progress'
            ]);

            event(new BuildEvent($this->deployment_plan));

            // Login to environment
            $uuid = str_random(5);
            Config::set(["remote.connections.{$uuid}.host" => $environment->ip_address]);
            Config::set("remote.connections.{$uuid}.port", $environment->ssh_port);
            Config::set("remote.connections.{$uuid}.username", $environment->ssh_username);

            if ($environment->authentication_type === 'password') {
                Config::set("remote.connections.{$uuid}.password", $environment->ssh_password);
            } else {
                Config::set("remote.connections.{$uuid}.key", Storage::url("ssh_keys/{$environment->ssh_password}"));
            }

            try {
                // Organize commands for execution
                $commands = preg_replace('/[\x00-\x1F\x7F]/', '', $this->deployment_plan->commands);
                $commands = preg_split('/[;]/', $commands, PREG_SPLIT_DELIM_CAPTURE);
                dd($commands);
                \SSH::into($uuid)->run($commands,  function ($line) {
                    echo $line.PHP_EOL;
                });
            } catch (\Exception $e) {
                $this->deployment_plan->update([
                    'status' => 'complete',
                    'build_id' => $build->id
                ]);
                $build->update([
                    'status' => 'failed'
                ]);
            }

            $this->deployment_plan->update([
                'status' => 'complete',
                'build_id' => $build->id
            ]);
            $build->update([
                'status' => 'complete'
            ]);

            event(new BuildEvent($this->deployment_plan));
        }
    }
}
