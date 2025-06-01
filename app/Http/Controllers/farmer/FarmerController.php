<?php

namespace App\Http\Controllers\farmer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Member;
use App\Models\Project;
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
        return view('farmer.index.blade.php');
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
        $member = Member::where('user_id', $id)->first();

        if (!$member) {
            return back()->with('error', 'This user is not registered as a member and cannot be deleted.');
        }
        $assignedToProject = Project::whereJsonContains('id_individual', (string) $id)->exists();

        if ($assignedToProject) {
            return back()->with('error', 'This member cannot be deleted because they are assigned to at least one project. Please unassign them before proceeding.');
        }
        $member->delete();

        return back()->with('success', 'Member deleted successfully.');
    }


    public function showEvent()
    {
        $projects = Project::all();
        $events = Event::all();
        return view('farmer.event',compact('events','projects'));
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
            'project_id' => 'required|exists:projects,id',
            'individuals' => 'required|array',
            'individuals.*' => 'exists:users,id',
        ]);


        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date_attribute = $request->attribute_date;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->project_id = $request->project_id;
        $event->individual_ids = json_encode($request->individuals);

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
            'project_id' => 'required|exists:projects,id',
            'individuals' => 'nullable|array',
            'individuals.*' => 'exists:users,id',
        ]);

        $event = Event::findOrFail($id);

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date_attribute' => $request->date_attribute,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'project_id' => $request->project_id,
            'individual_ids' => $request->individuals ?? [],
        ]);

        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('events', 'public');
            $event->picture = $imagePath;
            $event->save();
        }

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
        $projects = Project::all();
        $tasks = Task::latest()->get();

        return view('farmer.task', compact('projects', 'tasks'));
    }

    public function getProjectIndividuals($id)
    {
        $project = Project::findOrFail($id);


        // Decode JSON to array
        $ids = json_decode($project->id_individual, true) ?? [];

        // Fetch only those users with role=individual and who exist in the project
        $individuals = User::where('role', 'individual')
            ->whereIn('id', $ids)
            ->get(['id', 'name', 'email']); // only needed fields

        return response()->json($individuals);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'number' => 'required|integer',
            'status' => 'required|in:0,1',
            'project_id' => 'required|exists:projects,id',
            'individuals' => 'required|array',
            'individuals.*' => 'exists:users,id',
        ]);

        // Store the task
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'number' => $request->number,
            'status' => $request->status,
            'project_id' => $request->project_id,
            // Use json_encode to store the array as a JSON string
            'individual_ids' => json_encode($request->individuals),
        ]);

        // Notify only the assigned individuals
        $assignedUsers = User::whereIn('id', $request->individuals)->get();
        foreach ($assignedUsers as $user) {
            $user->notify(new TaskCreatedNotification($task));
        }

        return back()->with('success', 'Task created and assigned individuals notified.');
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

    public function showProject()
    {
        // Get all projects
        $projects = Project::all();

        // Decode JSON field for each project
        foreach ($projects as $project) {
            $project->id_individual = json_decode($project->id_individual, true) ?? [];
        }

        // Get only individual users that exist in member table
        $individuals = User::where('role', 'individual')
            ->whereHas('member') // only those who have a related member
            ->get();
        return view('farmer.project', compact('projects', 'individuals'));
    }


    public function handleAddProject(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'id_individual' => 'nullable|array', // Optional JSON array
        ]);

        Project::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'id_individual'=> $request->id_individual ? json_encode($request->id_individual) : null,
        ]);

        return redirect()->back()->with('success', 'Project added successfully.');
    }

    public function handleUpdateProject(Request $request, $id)
    {

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'status'      => 'required|integer|in:0,1,2',
            'id_individual' => 'nullable|array',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'status'       => $request->status,
            'id_individual'=> $request->id_individual ? json_encode($request->id_individual) : null,
        ]);

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    public function handleDeleteProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }





}
