<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'PageController@login')->name('view.login');
    Route::post('/login', 'Auth\AuthController@login')->name('login');

    // Authenticated routes
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'DeploymentPlanController@view')->name('view.index');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

        // Deployment plans
        Route::get('/deployment', 'DeploymentPlanController@view')->name('view.deployment-plans');
        Route::get('/deployment/create', 'DeploymentPlanController@create')->name('create.deployment-plan');
        Route::post('/deployment/create', 'DeploymentPlanController@store')->name('store.deployment-plan');
        Route::get('/deployment/edit/{plan}', 'DeploymentPlanController@edit')->name('edit.deployment-plan');
        Route::post('/deployment/edit/{plan}', 'DeploymentPlanController@update')->name('update.deployment-plan');
        Route::post('/deployment/delete/{plan}', 'DeploymentPlanController@delete')->name('delete.deployment-plan');

        // Projects
        Route::get('/projects', 'ProjectController@view')->name('view.projects');
        Route::get('/project/create', 'ProjectController@create')->name('create.project');
        Route::post('/project/create', 'ProjectController@store')->name('store.project');
        Route::get('/project/edit/{project}', 'ProjectController@edit')->name('edit.project');
        Route::post('/project/edit/{project}', 'ProjectController@update')->name('update.project');
        Route::post('/project/delete/{project}', 'ProjectController@delete')->name('delete.project');
    });
});

