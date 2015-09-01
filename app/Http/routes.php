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

// Patterns
Route::pattern('id', '\d+');

// Home
Route::get('/', function () {
    return view('index');
});

// Events
Route::resource('event', 'EventController');

// Participants
Route::resource('participant', 'ParticipantController');

// Users
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@login');
Route::post('auth/login', 'Auth\AuthController@authenticate');

Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@register');
Route::post('auth/register', 'Auth\AuthController@create');




// API

Route::group(['prefix' => 'api/v1/event'], function () {

    Route::get('get/all', function(){
        return Poolarna\Event::all();
    });

    Route::get('get/{id}', function($id){
        return Poolarna\Event::findOrFail($id);
    });

});

