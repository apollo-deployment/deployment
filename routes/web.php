<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'PageController@login')->name('view.login');
    Route::post('/login', 'Auth\AuthController@login')->name('login');
    Route::get('/login/google', 'Auth\AuthController@redirectToGoogle')->name('login.google');
    Route::get('/login/google/callback', 'Auth\AuthController@googleCallback');

    Route::get('/register', 'OrganizationController@create')->name('create.org');
    Route::post('/register', 'OrganizationController@store')->name('register.org');
    Route::get('/verify/{token}', 'OrganizationController@verify')->name('verify.org');

    // Authenticated routes
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'DeploymentPlanController@view')->name('view.index');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');
        Route::get('/profile', 'PageController@profile')->name('view.profile');
        Route::post('/profile/update', 'Auth\AuthController@updateProfile')->name('update.profile');
        Route::post('/profile/update-password', 'Auth\AuthController@updatePassword')->name('update.password');

        // Organizations
        Route::prefix('organization')->group(function () {
            Route::get('/edit/{organization}', 'OrganizationController@edit')->name('edit.org');
            Route::post('/edit/{organization}', 'OrganizationController@update')->name('update.org');
        });

        // Deployment plans
        Route::prefix('deployments')->group(function () {
            Route::get('/', 'DeploymentPlanController@view')->name('view.deployment-plans');
            Route::get('/create', 'DeploymentPlanController@create')->name('create.deployment-plan');
            Route::post('/create', 'DeploymentPlanController@store')->name('store.deployment-plan');
            Route::get('/edit/{plan}', 'DeploymentPlanController@edit')->name('edit.deployment-plan');
            Route::post('/edit/{plan}', 'DeploymentPlanController@update')->name('update.deployment-plan');
            Route::post('/delete/{plan}', 'DeploymentPlanController@delete')->name('delete.deployment-plan');
        });

        // Repositories
        Route::prefix('repositories')->group(function () {
            Route::get('/', 'RepositoryController@view')->name('view.repositories');
            Route::get('/create', 'RepositoryController@create')->name('create.repository');
            Route::post('/create', 'RepositoryController@store')->name('store.repository');
            Route::get('/edit/{repository}', 'RepositoryController@edit')->name('edit.repository');
            Route::post('/edit/{repository}', 'RepositoryController@update')->name('update.repository');
            Route::post('/delete/{repository}', 'RepositoryController@delete')->name('delete.repository');
        });

        // Environments
        Route::prefix('environments')->group(function () {
            Route::get('/', 'EnvironmentController@view')->name('view.environments');
            Route::get('/create', 'EnvironmentController@create')->name('create.environment');
            Route::post('/create', 'EnvironmentController@store')->name('store.environment');
            Route::get('/edit/{environment}', 'EnvironmentController@edit')->name('edit.environment');
            Route::post('/edit/{environment}', 'EnvironmentController@update')->name('update.environment');
            Route::post('/delete/{environment}', 'EnvironmentController@delete')->name('delete.environment');
        });
    });

    // GitHub API Routes
    Route::prefix('github')->group(function () {
        Route::get('/branches', 'Api\GitHubController@getBranches');
        Route::get('/access', 'Api\GitHubController@getAccess')->name('github.access');
        Route::get('/access/callback', 'Api\GitHubController@getAccessCallback');
    });
});

