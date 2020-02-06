<?php

namespace App\Http\Controllers;

use App\Models\IncidentUpdate;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Component;
use Illuminate\Http\Response;

class IncidentController extends Controller
{
    /**
     * Display a listing of incidents.
     *
     * @param Request $request
     * @param int $component_id
     * @return Response
     */
    public function index(Request $request, int $component_id)
    {
        if (!Component::find($component_id)) {
            return response('Component not found.', 400);
        }

        return response(Incident::where('component_id', $component_id)->get(), 200);
    }

    /**
     * Show the form for creating a new incident.
     *
     * @return void
     */
    public function create()
    {

    }

    /**
     * Create a new incident.
     *
     * @param Request $request
     * @param int $component_id
     * @return Response
     */
    public function store(Request $request, int $component_id)
    {
        $component = Component::find($component_id);

        if (!component) {
            return response('Component not found.', 400);
        }

        $this->validate($request, [
            'name' => 'required',
            'date' => 'required|date',
            'status' => 'int'
        ]);

        $incident = Incident::create([
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'occurred_at' => $request->input('date')
        ]);

        $component->incidents()->save($incident);

        return response('Incident created.', 200);
    }

    /**
     * Return details for a single incident.
     *
     * @param Request $request
     * @param int $component_id
     * @param int $incident_id
     * @return Response
     */
    public function show(Request $request, int $component_id, int $incident_id)
    {
        if (!Component::find($component_id)) {
            return response('Component not found.', 400);
        }

        $incident = Incident::find($incident_id);

        if (!$incident) {
            return response('Incident not found.', 400);
        }

        return $incident;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $component_id
     * @param int $incident_id
     * @return void
     */
    public function edit(Request $request, int $component_id, int $incident_id)
    {

    }

    /**
     * Update incident with IncidentUpdate.
     *
     * @param Request $request
     * @param int $component_id
     * @param int $incident_id
     * @return void
     */
    public function update(Request $request, int $component_id, int $incident_id)
    {
        if (!Component::find($component_id)) {
            return response('Component not found.', 400);
        }

        $incident = Incident::find($incident_id);

        if (!$incident) {
            return response('Incident not found.', 400);
        }

        $this->validate($request, [
            'name' => 'required',
            'message' => 'required',
            'date' => 'required|date',
            'status' => 'int'
        ]);

        return response(
            IncidentUpdate::create([
                'incident_id' => $incident->id,
                'user_id' => $request->user()->id,
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'message' => $request->input('message')
            ]), 200
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $component_id
     * @param int $incident_id
     * @return Response
     */
    public function destroy(Request $request, int $component_id, int $incident_id)
    {
        if (!Component::find($component_id)) {
            return response('Component not found.', 400);
        }

        $incident = Incident::find($incident_id);

        if (!$incident) {
            return response('Incident not found.', 400);
        }

        $incident->delete();

        return response('Incident deleted.', 200);
    }
}
