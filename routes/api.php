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
     * Fetch all incidents for a given component.
     */
    Route::get('components/{component}', 'IncidentController@index');

    /**
     * Create incident.
     */
    Route::post('components/{component}/incidents/create', 'IncidentController@store');

    /**
     * Read incident details.
     */
    Route::get('components/{component}/incidents/{incident}', 'IncidentController@show');

    /**
     * Add update to incident.
     */
    Route::get('components/{component}/incidents/{incident}/update', 'IncidentControllers@update');

    /**
     * Delete incident and assocaited updates.
     */
    Route::post('components/{component}/incidents/{incident}/delete', 'IncidentController@destroy');
});

