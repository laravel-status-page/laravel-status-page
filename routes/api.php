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
    Route::get('components/{component_id}', 'IncidentController@index')
        ->where('component_id', '[0-9]+');

    /**
     * Create incident.
     */
    Route::post('components/{component_id}/incidents/create', 'IncidentController@store')
        ->where('component_id', '[0-9]+');

    /**
     * Read incident details.
     */
    Route::get('components/{component_id}/incidents/{incident_id}', 'IncidentController@show')
        ->where('component_id', '[0-9]+')
        ->where('incident_id', '[0-9]+');

    /**
     * Add update to incident.
     */
    Route::get('components/{component_id}/incidents/{incident_id}/update', 'IncidentControllers@update')
        ->where('component_id', '[0-9]+')
        ->where('incident_id', '[0-9]+');
});

