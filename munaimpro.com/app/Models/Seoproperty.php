<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seoproperty extends Model
{
    use HasFactory;

    protected $fillable = ['page_name', 'site_title', 'site_keywords', 'site_description', 'og_site_name', 'og_url', 'og_title', 'og_description', 'og_image'];
}
