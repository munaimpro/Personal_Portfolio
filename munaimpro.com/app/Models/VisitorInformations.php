<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorInformations extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'visitor_country', 'visitor_city', 'visitor_device_type', 'visitor_operating_system', 'visitor_browser', 'visitor_screen_resolution', 'total_visit', 'last_visiting_time'];
}
