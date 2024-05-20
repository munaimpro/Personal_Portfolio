<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $filllable = ['post_heading', 'post_slug', 'post_thumbnail', 'post_descrption', 'post_view', 'category_id', 'user_id', 'publish_time', 'post_status'];

    // Relationship with user
    public function user():BelongsTo{
        return $this->belongsTo('users');
    }

    // Relationship with category
    public function category():BelongsTo{
        return $this->belongsTo('categories');
    }
}
