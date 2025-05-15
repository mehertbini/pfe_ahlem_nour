<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'status', 'id_individual'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }





}
