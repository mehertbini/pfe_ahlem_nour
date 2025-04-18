<?php

namespace App\Http\Controllers\distributor;

use App\Http\Controllers\Controller;
use App\Models\distributor;
use Illuminate\Http\Request;

class distributorController extends Controller
{
    public function index()
    {
        $datas = distributor::all();
        return view('distributor.index',compact('datas'));
    }

    public function handleAddDistributor(Request $request)
    {
        $request->validate([
            'name_dist' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Distributor::create([
            'name_dist' => $request->name_dist,
            'destination' => $request->destination,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Distributor added successfully.');
    }

    /**
     * Handle updating an existing distributor.
     */
    public function handleUpdateDistributor(Request $request,$id)
    {
        $request->validate([

            'name_dist' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $distributor = Distributor::find($id);
        $distributor->update([
            'name_dist' => $request->name_dist,
            'destination' => $request->destination,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back()->with('success', 'Distributor updated successfully.');
    }

    /**
     * Handle deleting a distributor.
     */
    public function handleDeleteDistributor($id)
    {
        Distributor::find($id)->delete();

        return back()->with('success', 'Distributor deleted successfully.');
    }
    public function showDistributorControllerPageChangeProfile()
    {
        return view('distributor.profile');
    }

    public function showDistributorPageChangePassword()
    {
        return view('distributor.password');
    }
}
