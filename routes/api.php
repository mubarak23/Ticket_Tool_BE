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

Route::group(['prefix' => 'ticket'], function () {

    Route::post('create_ticket', [
        'uses' => 'TicketController@create_ticket',
        'as' => 'Create Ticket'
    ]);

    Route::post('create_action_ticket', [
        'uses' => 'ActionTicketController@create_action_on_ticket',
        'as' => 'Create Acttion on Ticket'
    ]);


    Route::get('user_ticket_lists/{user_id}', [
        'uses' => 'TicketController@user_ticket_lists',
        'as' => 'Ticket lists created by specific user'
    ]);

    Route::get('user_action_tickets/{user_id}', [
        'uses' => 'ActionTicketController@user_action_tickets',
        'as' => 'Action on Ticket lists created by specific user'
    ]);

    


 });
