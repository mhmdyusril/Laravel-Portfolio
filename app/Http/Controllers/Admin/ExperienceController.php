<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company'      => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'start_date'   => 'required|string|max:50',
            'end_date'     => 'nullable|string|max:50',
            'is_current'   => 'boolean',
            'descriptions' => 'required|string',
            'sort_order'   => 'nullable|integer',
        ]);
        $data['is_current']   = $request->boolean('is_current');
        $data['descriptions'] = array_filter(explode("\n", $data['descriptions']));
        Experience::create($data);
        return back()->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'company'      => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'start_date'   => 'required|string|max:50',
            'end_date'     => 'nullable|string|max:50',
            'is_current'   => 'boolean',
            'descriptions' => 'required|string',
            'sort_order'   => 'nullable|integer',
        ]);
        $data['is_current']   = $request->boolean('is_current');
        $data['descriptions'] = array_filter(explode("\n", $data['descriptions']));
        $experience->update($data);
        return back()->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Pengalaman berhasil dihapus.');
    }
}
