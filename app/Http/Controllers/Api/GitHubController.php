<?php

namespace App\Http\Controllers\Api;

use App\Api\GitHub;
use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class GitHubController extends Controller
{
    private $github;

    public function __construct()
    {
        $this->github = new GitHub;
    }

    /**
     * AJAX : Gets all branches for a repository
     */
    public function getBranches()
    {
        $repository = Repository::find(request('repository_id'));

        return $this->github->getBranches($repository->owner, $repository->name);
    }

    /**
     * Redirects to GitHub to get user access to web-hooks & public/private repositories
     */
    public function getAccess()
    {
        return Redirect::away('https://github.com/login/oauth/authorize' .
            '?client_id=' . env('GITHUB_ID') .
            '&scope=admin:repo_hook repo' //.
//            '&redirect_uri=' . env('APP_URL') . '/github/access/callback'
        );
    }

    /**
     * Callback from GitHub for getAccess()
     */
    public function getAccessCallback()
    {
        $token = $this->github->getAccessToken(request('code'));

        Auth::user()->update([
           'github_access_token' => Crypt::encryptString($token)
        ]);

        return redirect()->route('view.profile')->with(['message' => 'Successfully linked up GitHub account']);
    }

    /**
     * Callback from GitHub for getPayload()
     * @param Request $request
     * @return string
     */
    public function getPayload(Request $request)
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
}
