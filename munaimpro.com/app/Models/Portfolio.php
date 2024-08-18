<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['project_title', 'project_thumbnail', 'project_ui_image', 'project_type', 'service_id', 'project_description', 'client_name', 'client_designation', 'project_starting_date', 'project_ending_date', 'project_url', 'core_technology', 'project_view', 'project_status'];

    // Relationship with service
    public function service():BelongsTo{
        return $this->belongsTo(Service::class);
    }
}
