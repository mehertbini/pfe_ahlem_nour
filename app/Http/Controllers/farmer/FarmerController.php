<?php

namespace App\Http\Controllers\farmer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Member;
use App\Models\Stock;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskCreatedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'plantDate' => 'required|date|before:harvestDate',
            'health' => 'required|in:Good,Average,Poor',
        ]);

        // Check manually if harvestDate is at least 2 months after plantDate
        $plantDate = Carbon::parse($request->plantDate);
        $harvestDate = Carbon::parse($request->harvestDate);


        if ($plantDate->diffInMonths($harvestDate) < 2) {
            return redirect()->back()->withErrors(['harvestDate' => 'The harvest date must be at least 2 months after the plant date.']);
        }

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
        'plantDate' => 'required|date|before:harvestDate',
        'health' => 'required|in:Good,Average,Poor',
    ]);

    // Manual verification of 2-month gap
    $plantDate = Carbon::parse($request->plantDate);
    $harvestDate = Carbon::parse($request->harvestDate);

    if ($plantDate->diffInMonths($harvestDate) < 2) {
        return back()->withErrors(['harvestDate' => 'The harvest date must be at least 2 months after the plant date.']);
    }

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

    public function showPageChangePassword()
    {
        return view('farmer.password');
    }


    public function showPageChangeProfile()
    {
        return view('farmer.profile');
    }


    public function changeProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->update();

        return back()->with('success', 'Profile updated successfully!');
    }


    public function showMember()
    {
        $membres = User::where('role','individual')->latest()->get();
        return view('farmer.member',compact('membres'));
    }



    public function confirmUserAndAddToMembers($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->role === 'individual') {
            // Add to members only if not already a member
            if (!$user->member) {
                Member::create([
                    'user_id' => $user->id
                ]);
            }
        }

        $user->save();

        return back()->with('success','User added to members.');
    }



    public function handleUpdateMember(Request $request, $id)
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

        return redirect()->back()->with('success', 'Member updated successfully!');
    }
    public function handleDeleteMember($id)
    {
        // Find the member record, not the user record
        $member = Member::where('user_id', $id)->first(); // Assuming `user_id` links members to users

        if (!$member) {
            return back()->with('error', 'User is not a member and cannot be deleted.');
        }

        // Delete the member
        $member->delete();

        return back()->with('success', 'Member deleted successfully.');
    }

    public function showEvent()
    {
        $events = Event::all();
        return view('farmer.event',compact('events'));
    }

    public function handleAddEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attribute_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date_attribute = $request->attribute_date;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;

        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('events', 'public');
            $event->picture = $imagePath;
        }

        $event->save();

        return redirect()->back()->with('success', 'Event added successfully');
    }

    public function handleUpdateEvent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_attribute' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $event = Event::find($id);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->date_attribute = $request->date_attribute;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;

        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('events', 'public');
            $event->picture = $imagePath;
        }

        $event->save();

        return redirect()->back()->with('success', 'Event updated successfully');
    }

    public function handleDeleteEvent($id)
    {
        $event = Event::find($id);
        if ($event->picture) {
            Storage::disk('public')->delete($event->picture);
        }
        $event->delete();
        return redirect()->back()->with('success', 'Event deleted successfully');
    }



    public function showTask()
    {
        $tasks = Task::latest()->get();
        return view('farmer.task', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'number' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $task = Task::create($request->all());

        // Notify all users with role 'individual'
        $individualUsers = User::where('role', 'individual')->get();
        foreach ($individualUsers as $user) {
            $user->notify(new TaskCreatedNotification($task));
        }

        return back()->with('success', 'Task added and individuals notified.');
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'number' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);

        $task->update($request->all());

        return back()->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return back()->with('success', 'Task deleted successfully.');
    }




}
