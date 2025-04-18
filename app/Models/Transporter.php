<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    protected $fillable = [
        'type_transporter',
        'start_date',
        'end_date',
        'destination',
        // add other fillable fields if needed
    ];
}
