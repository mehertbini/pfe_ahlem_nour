<?php

namespace App\Http\Controllers\individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class individualController extends Controller
{
    public function index()
    {
        return view('individual.index');
    }
}
