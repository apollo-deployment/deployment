<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'PageController@login')->name('view.login');
    Route::post('/login', 'Auth\AuthController@login')->name('login');

    // Authenticated routes
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'PageController@deployment')->name('view.index');
        Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

        // Deployment plans
        Route::get('/deployment', 'DeploymentPlanController@view')->name('view.deployment-plans');
        Route::get('/deployment/edit/{plan}', 'DeploymentPlanController@edit')->name('edit.deployment-plan');
        Route::post('/deployment/edit/{plan}', 'DeploymentPlanController@update')->name('update.deployment-plan');
        Route::post('/deployment/delete/{plan}', 'DeploymentPlanController@delete')->name('delete.deployment-plan');


        Route::get('/web-servers', 'PageController@webServers')->name('view.web-servers');
        Route::get('/projects', 'PageController@projects')->name('view.projects');
    });
});

