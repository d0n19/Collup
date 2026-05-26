<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'cover_letter' => $request->message,
        ]);

        Application::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'cover_letter' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard');
    }
    public function feed() { return view('newsfeed'); }
    public function jobs() { return view('jobs'); }
    public function workspace() { return view('workspace'); }
    public function friends() { return view('friends'); }
    public function profile() { return view('dashboard'); }
}