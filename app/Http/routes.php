<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Rota para pegar o Token*/
Route::post('oauth/access_token', function (){
    return Response::json(Authorizer::issueAccessToken());
});


Route::group(['middleware' => 'oauth'], function (){
    /*Rotas referentes aos Clients*/
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    /*Rotas referentes aos Projects*/
    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);


    Route::group(['prefix' => 'project'], function () {
        /*Rotas referentes aos Projects Notes*/
        Route::get('{id}/note', 'ProjectNotesController@index');
        Route::post('{id}/note', 'ProjectNotesController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNotesController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNotesController@update');
        Route::delete('note/{noteId}', 'ProjectNotesController@destroy');

        /*Rotas referentes aos Projects Files*/
        Route::post('{id}/file', 'ProjectFilesController@store');

        /*Rotas referentes aos Projects Tasks*/
        Route::get('{id}/task', 'ProjectTasksController@index');
        Route::post('{id}/task', 'ProjectTasksController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTasksController@show');
        Route::put('{id}/task/{taskId}', 'ProjectTasksController@update');
        Route::delete('task/{taskId}', 'ProjectTasksController@destroy');

        /*Rotas referentes aos Projects Files*/
        Route::get('{id}/members', 'ProjectController@members');
    });
});






