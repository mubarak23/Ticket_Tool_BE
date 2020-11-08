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

	//create_ticket
    Route::post('create_ticket', [
        'uses' => 'TicketController@create_ticket',
        'as' => 'Create Ticket'
    ]);

    //create_action_ticket
    Route::post('create_action_ticket', [
        'uses' => 'ActionTicketController@create_action_on_ticket',
        'as' => 'Create Action on Ticket'
    ]);

    //case_id ig9XsAYEEX



    //update_ticket_status
    Route::put('update_ticket_status', [
        'uses' => 'TicketController@update_ticket_status',
        'as' => 'Update status on Ticket'
    ]);


    //user_ticket_lists
    Route::get('user_ticket_lists/{user_id}', [
        'uses' => 'TicketController@user_ticket_lists',
        'as' => 'Ticket lists created by specific user'
    ]);

    //single ticket details
    Route::get('ticket_details/{case_id}', [
        'uses' => 'TicketController@ticket_details',
        'as' => 'Ticket Details'
    ]);

    //user_action_tickets
    Route::get('user_action_tickets/{user_id}', [
        'uses' => 'ActionTicketController@user_action_tickets',
        'as' => 'Action on Ticket lists created by specific user'
    ]);

    //Ticket_details
    Route::get('ticket_details/{user_id}/{case_id}', [
        'uses' => 'TicketController@Ticket_details',
        'as' => 'Ticket Details'
    ]);


 });


Route::group(['prefix' => 'auth'], function () {

    Route::post('register', [
        'uses' => 'UserController@RegisterAccount',
        'as' => 'User Auth Register'
    ]);

    Route::post('AuthLogin', [
        'uses' => 'UserController@AuthLogin',
        'as' => 'User Auth Login'
    ]);


 });
