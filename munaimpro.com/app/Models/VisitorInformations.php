<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorInformations extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'visitor_country', 'visitor_browser', 'total_visit', 'last_visiting_time'];
}
