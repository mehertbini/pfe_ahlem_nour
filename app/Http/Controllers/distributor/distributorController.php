<?php

namespace App\Http\Controllers\distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class distributorController extends Controller
{
    public function index()
    {
        return view('distributor.index');
    }
}
