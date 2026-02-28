<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'role', 'description', 'impact', 'technologies', 'github_url', 'demo_url', 'image', 'is_featured', 'sort_order'];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
    ];
}
