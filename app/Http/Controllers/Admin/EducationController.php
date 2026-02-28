<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::all();
        return view('admin.educations.index', compact('educations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'institution' => 'required|string|max:255',
            'degree'      => 'required|string|max:255',
            'field'       => 'required|string|max:255',
            'start_year'  => 'required|string|max:10',
            'end_year'    => 'required|string|max:10',
        ]);
        Education::create($data);
        return back()->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    public function update(Request $request, Education $education)
    {
        $data = $request->validate([
            'institution' => 'required|string|max:255',
            'degree'      => 'required|string|max:255',
            'field'       => 'required|string|max:255',
            'start_year'  => 'required|string|max:10',
            'end_year'    => 'required|string|max:10',
        ]);
        $education->update($data);
        return back()->with('success', 'Pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return back()->with('success', 'Pendidikan berhasil dihapus.');
    }
}
