<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class distributor extends Model
{
    protected $fillable = [
        'name_dist',
        'destination',
        'start_date',
        'end_date',

    ];
}
