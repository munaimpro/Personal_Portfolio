<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'greetings', 'full_name', 'designation', 'hero_description', 'hero_image', 'about_description', 'about_image', 'email', 'phone', 'location', 'resume_link', 'skill_description'
    ];
}
