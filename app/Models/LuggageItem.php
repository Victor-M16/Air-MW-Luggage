<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuggageItem extends Model
{
    use HasFactory;

    // Define the relationship with the Bag model
    public function bags()
    {
        return $this->belongsTo(Bag::class);
    }
}
