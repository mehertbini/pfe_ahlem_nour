<?php

namespace App\Http\Controllers\transporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class transporterController extends Controller
{
    public function index()
    {
        return view('transporter.index');
    }
}
