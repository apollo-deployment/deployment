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
     * @param Request $request
     * @return mixed
     */
    public function getBranches(Request $request)
    {
        $repository = Repository::find(1);
        return $this->github->getBranches($repository->owner, $repository->name);
    }

    /**
     * AJAX : Gets all hooks fo4r a repository
     * @param Request $request
     * @return mixed test commit123
     */
    public function getHooks(Request $request)
    {
        //$repository = Repository::find($request->get('repository_id'));

        \Log::info ($request);
        $repository = Repository::find(1);
        \Log::info ($repository);


        return $this->github->getHooks($repository->owner, $repository->name);
    }

    public function createHooks(Request $request)
    {
        // create
        // POST /repos/:owner/:repo/hooks
        // https://api.github.com/repos/octocat/Hello-World/hooks/1
        //api-post(repos/rustyhumfleet/rollaball/hooks)
        // end create

        $repository = Repository::find(1);
//        \Log::info ($repository);

        return $this->github->createHooks($repository->owner, $repository->name);
    }

    /**
     * Redirects to GitHub to get user access to web-hooks & public/private repositories
     */
    public function getAccess()
    {
        return Redirect::away('https://github.com/login/oauth/authorize' .
            '?client_id=' . env('GITHUB_ID') .
            '&scope=admin:repo_hook repo' .
            '&redirect_uri=' . env('APP_URL') . '/github/access/callback'
        );
    }

    /**
     * Callback from GitHub for getAccess()
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAccessCallback(Request $request)
    {
        $token = $this->github->getAccessToken($request->get('code'));

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
        \Log::info('this is a nice fuckin fish');
//        $plan = DeploymentPlan::create([
//            'title' => $request->get('title'),
//            'environment_id' => $request->get('environment_id'),
//            'repository_id' => $request->get('repository_id'),
//            'repository_branch' => $request->get('repository_branch'),
//            'is_automatic' => true, // CHANGE
//            'remote_path' => $request->get('remote_path'),
//        ]);
        //this->api-post(repos/owner/reponame/hooks)
        //on the repository controller on store and update you can create one after

        return json_encode('this is a nice fuckin fish');
    }


}
