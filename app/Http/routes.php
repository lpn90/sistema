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

/*Rotas referente aos Clients*/

Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::get('client/{id}', 'ClientController@show');
Route::put('client/{id}', 'ClientController@update');
Route::delete('client/{id}', 'ClientController@destroy');

/*Rotas referentes aos Projects Notes*/

Route::get('project/{id}/note', 'ProjectNotesController@index');
Route::post('project/{id}/note', 'ProjectNotesController@store');
Route::get('project/{id}/note/{noteId}', 'ProjectNotesController@show');
Route::put('project/{id}/note/{noteId}', 'ProjectNotesController@update');
Route::delete('project/{id}/note/{noteId}', 'ProjectNotesController@destroy');

/*Rotas referentes aos Projects*/

Route::get('project', 'ProjectController@index');
Route::post('project', 'ProjectController@store');
Route::get('project/{id}', 'ProjectController@show');
Route::put('project/{id}', 'ProjectController@update');
Route::delete('project/{id}', 'ProjectController@destroy');

