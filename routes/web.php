<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'PageController@login')->name('view.login');

    // Authenticated routes
//    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'PageController@deployment')->name('view.index');
        Route::get('/deployment', 'PageController@deployment')->name('view.deployment-plans');
        Route::get('/web-servers', 'PageController@webServers')->name('view.web-servers');
        Route::get('/projects', 'PageController@projects')->name('view.projects');

        Route::resource('projects', 'ProjectController');
//        Route::resources([
//        'projects' => 'ProjectController',
////        'web-servers' => 'WebServerController'
//    ]);
//    });
});
