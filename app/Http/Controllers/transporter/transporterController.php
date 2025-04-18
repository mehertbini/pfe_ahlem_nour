<?php

namespace App\Http\Controllers\transporter;

use App\Http\Controllers\Controller;
use App\Models\Transporter;
use Illuminate\Http\Request;

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
        return view('transporter.route');
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
