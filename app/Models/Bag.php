<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    use HasFactory;

    // Define the relationship with the Customer model
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    // Define the relationship with the Bag model
    public function items()
    {
        return $this->hasMany(LuggageItem::class);
    }
}
