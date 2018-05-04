<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VerificationExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:verifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expires email verification codes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (User::where('verified', 0)->get() as $user) {
            $verification = $user->verifyUser()->first();

            // Remove user if verification is expired
            if ($verification->created_at->addHours(24) <= Carbon::now()) {
                $verification->delete();

                $organization = $user->organization()->first()->delete();

                $user->delete();
                $organization->delete();
            }
        }
    }
}
