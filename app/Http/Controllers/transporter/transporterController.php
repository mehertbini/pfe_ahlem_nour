<?php

namespace App\Http\Controllers\transporter;

use App\Http\Controllers\Controller;
use App\Models\Trajet;
use App\Models\Transporter;
use Illuminate\Http\Request;
use Geocoder\Provider\Nominatim\Nominatim;
use Geocoder\StatefulGeocoder;

class transporterController extends Controller
{
    public function index()
    {
        $datas = Transporter::all();
        return view('transporter.index',compact('datas'));
    }

    public function handleAddTransporter(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'type_transporter' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end_date is after or equal to start_date
            'destination' => 'required|string|max:255',
        ]);

        // Create a new Transporter record
        $transporter = new Transporter();
        $transporter->type_transporter = $validated['type_transporter'];
        $transporter->start_date = $validated['start_date'];
        $transporter->end_date = $validated['end_date'];
        $transporter->destination = $validated['destination'];

        // Save the transporter to the database
        $transporter->save();

        // Redirect back with success message
        return back()->with('success', 'Transporter added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_transporter' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'destination' => 'required|string|max:255',
        ]);

        $transporter = Transporter::findOrFail($id);
        $transporter->update($request->only(['type_transporter', 'start_date', 'end_date', 'destination']));

        return redirect()->back()->with('success', 'Transporter updated successfully.');
    }

    public function destroy($id)
    {
        $transporter = Transporter::findOrFail($id);
        $transporter->delete();

        return redirect()->back()->with('success', 'Transporter deleted successfully.');
    }




    public function showRoute()
    {
        $trajets = Trajet::all();

        return view('transporter.route', compact('trajets'));
    }

    public function handleAddTrip(Request $request)
    {
        $request->validate([
            'date_depart' => 'required|date',
            'date_arrive' => 'required|date',
            'point_depart' => 'required|string',
            'point_arrive' => 'required|string',
            'path' => 'required|string',
        ]);

        // Create a new trip
        Trajet::create([
            'date_depart' => $request->date_depart,
            'date_arrive' => $request->date_arrive,
            'point_depart' => $request->point_depart,
            'point_arrive' => $request->point_arrive,
            'path' => $request->path,
        ]);

        return back()->with('success', 'Trip added successfully!');
    }


    public function showMap($id)
    {
        $trajet = Trajet::findOrFail($id);

        $startCoords = $this->getCoordinates($trajet->point_depart);
        $endCoords = $this->getCoordinates($trajet->point_arrive);

        return view('transporter.leaflet', [
            'trajet' => $trajet,
            'startLat' => $startCoords['lat'] ?? 0,
            'startLng' => $startCoords['lon'] ?? 0,
            'endLat' => $endCoords['lat'] ?? 0,
            'endLng' => $endCoords['lon'] ?? 0,
        ]);
    }

    private function getCoordinates($location)
    {
        $query = urlencode($location);
        $url = "https://nominatim.openstreetmap.org/search?format=json&q={$query}";

        $opts = ['http' => ['header' => "User-Agent: Laravel-App"]];
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);

        $data = json_decode($response, true);
        return $data[0] ?? null;
    }

    public function handleUpdateRoute(Request $request, $id)
    {
        $trajet = Trajet::findOrFail($id);
        $trajet->update($request->only([
            'date_depart', 'date_arrive', 'point_depart', 'point_arrive', 'path'
        ]));

        return redirect()->back()->with('success', 'Trip updated successfully.');
    }

    public function destroyRoute($id)
    {
        Trajet::destroy($id);
        return redirect()->back()->with('success', 'Trip deleted successfully.');
    }


    public function showTransporterPageChangeProfile()
    {
        return view('Transporter.profile');
    }

    public function showTransporterPageChangePassword()
    {
        return view('Transporter.password');
    }
}
