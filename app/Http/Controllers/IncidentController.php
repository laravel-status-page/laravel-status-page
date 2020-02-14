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
     * @param Component $component
     * @return Response
     */
    public function index(Request $request, Component $component)
    {
        return response(Incident::where('component_id', $component->id)->get(), 200);
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
     * @param Component $component
     * @return Response
     */
    public function store(Request $request, Component $component)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required|date',
            'status' => 'int'
        ]);

        $component->incidents()->create([
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'occurred_at' => $request->input('date')
        ]);

        return response('Incident created.', 200);
    }

    /**
     * Return details for a single incident.
     *
     * @param Request $request
     * @param Component $component
     * @param Incident $incident
     * @return Response
     */
    public function show(Request $request, Component $component, Incident $incident)
    {
        if ($incident->component_id != $component->id) {
            return response('Incident not found for that component.', 404);
        }

        return $incident;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Component $component
     * @param Incidnet $incident
     * @return void
     */
    public function edit(Request $request, Component $component, Incidnet $incident)
    {

    }

    /**
     * Update incident with IncidentUpdate.
     *
     * @param Request $request
     * @param Component $component
     * @param Incident $incident
     * @return void
     */
    public function update(Request $request, Component $component, Incident $incident)
    {
        if ($incident->component_id != $component->id) {
            return response('Incident not found for that component.', 404);
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
     * @param Component $component
     * @param Incident $incident
     * @return Response
     */
    public function destroy(Request $request, Component $component, Incident $incident)
    {
        if ($incident->component_id != $component->id) {
            return response('Incident not found for that component.', 404);
        }

        $incident->delete();

        return response('Incident deleted.', 200);
    }
}
