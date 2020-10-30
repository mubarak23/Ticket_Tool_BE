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

    Route::post('create_icket', [
        'uses' => 'TicketController@create_ticket',
        'as' => 'Create Ticket'
    ]);

    Route::get('user_ticket_lists', [
        'uses' => 'TicketController@user_ticket_lists',
        'as' => 'Ticket lists created by specific user'
    ]);

 });
