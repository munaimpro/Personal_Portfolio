<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seoproperty extends Model
{
    use HasFactory;

    protected $fillable = ['page_name', 'site_title', 'site_keywords', 'site_description', 'author', 'og_site_name', 'og_url', 'og_title', 'og_description', 'og_type', 'og_image', 'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image', 'robots', 'canonical_url', 'application_name', 'theme_color', 'google_site_verification', 'referrer',];
}
