<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $personal = PersonalInfo::first();
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get()->groupBy('category');
        $experiences = Experience::orderBy('sort_order')->get();
        $educations = Education::all();
        $projects = Project::orderBy('sort_order')->get();

        return view('home.index', compact('personal', 'skills', 'experiences', 'educations', 'projects'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'subject', 'message'));

        return back()->with('success', 'Pesan Anda berhasil terkirim! Saya akan segera menghubungi Anda.');
    }
}
