<?php

namespace App\Http\Controllers\farmer;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmerController extends Controller
{
    public function index()
    {
        return view('farmer.index');
    }
    public function showStocks()
    {
        $stocks = Stock::latest()->get();
        return view('farmer.management-stock',compact('stocks'));
    }
    public function handleAddStock(Request $request)
    {
        // Validate request data
        $request->validate([
            'cropName' => 'required|string|max:255',
            'qte' => 'required|numeric|min:1',
            'unite' => 'required|string|max:50',
            'harvestDate' => 'required|date',
            'plantDate' => 'required|date',
            'health' => 'required|in:Good,Average,Poor',
        ]);

        // Create new stock instance
        $stock = new Stock();
        $stock->cropName = $request->cropName;
        $stock->qte = $request->qte;
        $stock->unite = $request->unite;
        $stock->harvestDate = $request->harvestDate;
        $stock->plantDate = $request->plantDate;
        $stock->health = $request->health;
        $stock->save(); // Save to database

        // Redirect back with success message
        return redirect()->back()->with('success', 'Stock added successfully.');
    }

    public function handleUpdateStock(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'cropName' => 'required|string|max:255',
            'qte' => 'required|numeric|min:1',
            'unite' => 'required|string|max:50',
            'harvestDate' => 'required|date',
            'plantDate' => 'required|date',
            'health' => 'required|in:Good,Average,Poor',
        ]);

        // Find the stock by ID
        $stock = Stock::findOrFail($id);

        // Update the stock attributes
        $stock->cropName = $request->cropName;
        $stock->qte = $request->qte;
        $stock->unite = $request->unite;
        $stock->harvestDate = $request->harvestDate;
        $stock->plantDate = $request->plantDate;
        $stock->health = $request->health;

        // Save the updated stock to the database
        $stock->save();

        // Redirect back with success message
        return back()->with('success', 'Stock updated successfully.');
    }

    public function handleDeleteStock($id)
    {
        Stock::find($id)->delete();
        return back()->with('success','Stock deleted successfully.');
    }

    public function showProfiles()
    {
        $users = User::where('role','transporter')->latest()->get();
        return view('farmer.management-profile',compact('users'));
    }

    public function handleUpdateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
