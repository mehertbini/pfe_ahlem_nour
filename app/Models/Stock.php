<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'cropName',
        'qte',
        'unite',
        'plantDate',
        'harvestDate',
        'health',
    ];

}
