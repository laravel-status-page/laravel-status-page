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


Route::group(['middleware' => ['auth:api']], function() {

    /**
     * Incident RESTful routing.
     */

    /**
     * Create incident.
     */
    Route::post('incident/create', 'IncidentController@create');

    /**
     * Read incident details.
     */
    Route::get('incident/{id}', 'IncidentController@show');

    /**
     * Add update to incident.
     */
    Route::get('incident/{id}/update', 'IncidentControllers@addUpdate');
});

