<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientFeedback extends Model
{
    use HasFactory;

    protected $table = 'client_feedbacks';
    
    protected $fillable = ['client_first_name', 'client_last_name', 'client_designation', 'client_image', 'client_feedback', 'portfolio_id'];

    // Relationship with client feedback
    public function portfolio(): BelongsTo{
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }

}
