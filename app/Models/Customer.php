<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'surname',
        'email',
        'phone_number',
        'ticket_number',
        'departure_point',
        'destination',
    ];
    
    //Other model methods and properties
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
