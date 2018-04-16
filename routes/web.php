<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'PageController@login')->name('view.login');
    Route::post('/login', 'Auth\AuthController@login')->name('login');

    // Authenticated routes
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'DeploymentPlanController@view')->name('view.index');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

        // Deployment plans
        Route::prefix('deployment')->group(function () {
            Route::get('/', 'DeploymentPlanController@view')->name('view.deployment-plans');
            Route::get('/create', 'DeploymentPlanController@create')->name('create.deployment-plan');
            Route::post('/create', 'DeploymentPlanController@store')->name('store.deployment-plan');
            Route::get('/edit/{plan}', 'DeploymentPlanController@edit')->name('edit.deployment-plan');
            Route::post('/edit/{plan}', 'DeploymentPlanController@update')->name('update.deployment-plan');
            Route::post('/delete/{plan}', 'DeploymentPlanController@delete')->name('delete.deployment-plan');
        });

        // Projects
        Route::prefix('projects')->group(function () {
            Route::get('/', 'ProjectController@view')->name('view.projects');
            Route::get('/create', 'ProjectController@create')->name('create.project');
            Route::post('/create', 'ProjectController@store')->name('store.project');
            Route::get('/edit/{project}', 'ProjectController@edit')->name('edit.project');
            Route::post('/edit/{project}', 'ProjectController@update')->name('update.project');
            Route::post('/delete/{project}', 'ProjectController@delete')->name('delete.project');
        });

        // Web servers
        Route::prefix('web_servers')->group(function () {
            Route::get('/', 'WebServerController@view')->name('view.web_servers');
            Route::get('/create', 'WebServerController@create')->name('create.web_server');
            Route::post('/create', 'WebServerController@store')->name('store.web_server');
            Route::get('/edit/{web_server}', 'WebServerController@edit')->name('edit.web_server');
            Route::post('/edit/{web_server}', 'WebServerController@update')->name('update.web_server');
            Route::post('/delete/{web_server}', 'WebServerController@delete')->name('delete.web_server');
        });
    });

    // GitHub API Routes
    Route::prefix('github')->group(function () {
        Route::get('/branches', 'Api\GitHubController@getBranches');
    });
});

