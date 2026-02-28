<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'role'         => 'nullable|string|max:255',
            'description'  => 'required|string',
            'impact'       => 'nullable|string',
            'technologies' => 'required|string',
            'github_url'   => 'nullable|url',
            'demo_url'     => 'nullable|url',
            'is_featured'  => 'boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        $data['technologies'] = array_filter(explode(',', $data['technologies']));
        $data['technologies'] = array_map('trim', $data['technologies']);
        $data['is_featured']  = $request->boolean('is_featured');
        Project::create($data);
        return back()->with('success', 'Project berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'role'         => 'nullable|string|max:255',
            'description'  => 'required|string',
            'impact'       => 'nullable|string',
            'technologies' => 'required|string',
            'github_url'   => 'nullable|url',
            'demo_url'     => 'nullable|url',
            'is_featured'  => 'boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        $data['technologies'] = array_filter(explode(',', $data['technologies']));
        $data['technologies'] = array_map('trim', $data['technologies']);
        $data['is_featured']  = $request->boolean('is_featured');
        $project->update($data);
        return back()->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus.');
    }
}
