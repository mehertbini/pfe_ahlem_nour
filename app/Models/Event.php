<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'picture',
        'date_attribute',
        'start_date',
        'end_date',
        'project_id',
        'individual_ids'
    ];

}
