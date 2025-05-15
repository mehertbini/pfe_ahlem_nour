<?php

namespace App\Http\Controllers\individual;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class individualController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'individual') {
            abort(403);
        }

        $projects = Project::whereJsonContains('id_individual', (string)$user->id)
            ->with(['tasks' => function ($query) use ($user) {
                $query->whereJsonContains('individual_ids',(string)$user->id);
            }])
            ->get();
        return view('individual.index', compact('projects'));
    }


    public function getTasksByProject(Request $request)
    {
        $user = Auth::user();
        $projectId = $request->project_id;

        $tasks = Task::where('project_id', $projectId)
            ->whereJsonContains('individual_ids', (string)$user->id)
            ->get(['name', 'description', 'status']);

        return response()->json($tasks);
    }


    public function showIndividualPageChangePassword()
    {
        return view('individual.password');
    }
    public function showIndividualPageChangeProfile()
    {
        return view('individual.profile');
    }
}
