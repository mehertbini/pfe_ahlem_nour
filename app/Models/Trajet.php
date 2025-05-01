<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $table = 'trajets';  // Optional, if your table is not following the convention.

    // Define the fillable attributes
    protected $fillable = [
        'date_depart',    // Departure date
        'date_arrive',    // Arrival date
        'point_depart',   // Departure point
        'point_arrive',   // Arrival point
        'path',           // Path
    ];
}
