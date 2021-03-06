<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'], function() {
    Route::post('/newsletter', 'NewsletterController@store');
    Route::get('/events', 'EventsController@index');
});

Route::group(['prefix'=>'v1','middleware' => 'auth:api'], function() {
    //Users
    Route::get('/users', 'UsersController@index');

    Route::put('/users/{user}', 'UsersController@update');

    Route::put('/user', 'LoggedUserController@update');

    //Members
    Route::delete('/group/{group}/member', 'MembersController@destroy');

    //Numbers
    Route::get('/numbers', 'NumbersController@index');

    //Register Auth user to events
    Route::post('/events/{event}/register', 'RegisterToEventController@store');
    Route::delete('/events/{event}/register', 'RegisterToEventController@destroy');

    //Register users to events
    Route::post('/events/{event}/register/user/{user}', 'RegisterUserToEventController@store');
    Route::delete('/events/{event}/register/user/{user}', 'RegisterUserToEventController@destroy');

    Route::delete('/events/register/user/{user}', 'RegisterUserToAllEventsController@destroy');

    //Register group to event
    Route::post('/events/{event}/register_group', 'RegisterGroupToEventController@store');

    Route::delete('/events/{event}/register_group/{group}', 'RegisterGroupToEventController@destroy');

    // ASSIGN NUMBERS
    // Assign first available number to user
    Route::post('/user/{user}/assign_number', 'AssignNumberToUserController@store');
    // Unassign/free number
    Route::delete('/number/{number}/assign', 'AssignNumberToUserController@destroy');
    // Unassign all numbers assigned to an user
    Route::post('/user/{user}/unassign_numbers', 'UnassignNumbersToUserController@store');

    //Payments
    Route::post('/user/{user}/pay', 'UserPaymentsController@store');
    Route::delete('/user/{user}/pay', 'UserPaymentsController@destroy');

});

