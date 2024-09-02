<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedias extends Model
{
    use HasFactory;

    protected $fillable = ['social_media_title', 'social_media_link', 'social_media_icon', 'social_media_placement'];
}
