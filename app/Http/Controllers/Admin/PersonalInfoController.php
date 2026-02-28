<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    public function edit()
    {
        $personal = PersonalInfo::first();
        return view('admin.personal.edit', compact('personal'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'tagline'  => 'required|string|max:255',
            'bio'      => 'required|string',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'github'   => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        PersonalInfo::updateOrCreate(['id' => 1], $data);
        return redirect()->route('admin.personal.edit')->with('success', 'Data pribadi berhasil disimpan.');
    }
}
