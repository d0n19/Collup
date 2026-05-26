<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectRole;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['owner', 'category', 'roles'])->where('status', 'active');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('tech_stack', 'like', '%' . $request->search . '%');
        }

        $projects = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function show(Project $project)
    {
        $project->load(['owner', 'category', 'roles', 'applications.user']);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'roles' => 'required|array|min:1',
            'roles.*.name' => 'required|string',
            'roles.*.count' => 'required|integer|min:1',
        ]);

        $project = Auth::user()->projects()->create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'tech_stack' => $request->tech_stack,
        ]);

        foreach ($request->roles as $role) {
            $project->roles()->create([
                'name' => $role['name'],
                'required_count' => $role['count'],
            ]);
        }

        return redirect()->route('my-projects')->with('success', 'Project created successfully!');
    }

    public function apply(Request $request, Project $project)
    {
        $request->validate([
            'project_role_id' => 'required|exists:project_roles,id',
            'message' => 'required|string',
            'experience_links' => 'nullable|string',
        ]);

        Application::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'project_role_id' => $request->project_role_id,
            'message' => $request->message,
            'experience_links' => $request->experience_links,
        ]);

        return back()->with('success', 'Application submitted!');
    }

    public function handleApplication(Application $application, $status)
    {
        if (Auth::id() !== $application->project->user_id) {
            abort(403);
        }

        $application->update(['status' => $status]);

        return back()->with('success', "Application $status.");
    }

    public function myProjects()
    {
        $projects = Auth::user()->projects()->with('applications.user')->get();
        $applications = Auth::user()->applications()->with('project')->get();
        return view('projects.my-projects', compact('projects', 'applications'));
    }
}
