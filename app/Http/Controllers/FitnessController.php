<?php

namespace App\Http\Controllers;

use App\Models\Fitness;
use Illuminate\Http\Request;

class FitnessController extends Controller
{
    public function index()
    {
        $allUsers = Fitness::all();
        return view('fitness', compact('allUsers'));
    }
}
