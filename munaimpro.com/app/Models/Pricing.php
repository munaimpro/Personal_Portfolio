<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = ['pricing_title', 'pricing_price', 'pricing_features', 'pricing_status'];

    protected $casts = [
        'pricing_features' => 'array',
    ];
}
