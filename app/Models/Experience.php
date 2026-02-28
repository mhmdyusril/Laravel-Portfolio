<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['company', 'position', 'start_date', 'end_date', 'is_current', 'descriptions', 'sort_order'];

    protected $casts = [
        'descriptions' => 'array',
        'is_current' => 'boolean',
    ];
}
