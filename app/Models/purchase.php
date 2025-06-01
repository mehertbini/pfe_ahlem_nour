<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
class purchase extends Model
{

    protected $fillable = [
        'type_invoice',
        'name_customer',
        'product_ids',
        'status',
        'amount', // si tu enregistres aussi le montant total
    ];
    public function getProductListAttribute()
    {
        return Stock::whereIn('id', json_decode($this->product_ids ?? '[]'))->get();
    }
}
