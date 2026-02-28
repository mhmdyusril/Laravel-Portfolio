<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'skills'      => Skill::count(),
            'experiences' => Experience::count(),
            'projects'    => Project::count(),
            'messages'    => Contact::count(),
            'unread'      => Contact::where('is_read', false)->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
