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
    return view('app');
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


    Route::group(['prefix' => 'project', 'middleware'=>'check.project.permission'], function () {
        /*Rotas referentes aos Projects Notes*/
        Route::get('{id}/note', 'ProjectNotesController@index');
        Route::post('{id}/note', 'ProjectNotesController@store');
        Route::get('{id}/note/{idNote}', 'ProjectNotesController@show');
        Route::put('{id}/note/{idNote}', 'ProjectNotesController@update');
        Route::delete('{id}/note/{idNote}', 'ProjectNotesController@destroy');

        /*Rotas referentes aos Projects Files*/
        Route::get('{id}/files', 'ProjectFilesController@index');
        Route::get('{id}/files/{fileId}', 'ProjectFilesController@show');
        Route::get('{id}/files/{fileId}/download', 'ProjectFilesController@showFile');
        Route::post('{id}/files', 'ProjectFilesController@store');
        Route::put('{id}/files/{fileId}', 'ProjectFilesController@update');
        Route::delete('{id}/files/{fileId}', 'ProjectFilesController@destroy');

        /*Rotas referentes aos Projects Tasks*/
        Route::get('{id}/task', 'ProjectTasksController@index');
        Route::post('{id}/task', 'ProjectTasksController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTasksController@show');
        Route::put('{id}/task/{taskId}', 'ProjectTasksController@update');
        Route::delete('{id}/task/{taskId}', 'ProjectTasksController@destroy');

        /*Rotas referentes aos Projects Files*/
        Route::get('{id}/members', 'ProjectController@members');
    });

    Route::get('user/authenticated', 'UserController@authenticated');

});






