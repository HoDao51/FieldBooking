<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fields = Field::where('status', 0)
                        ->latest()
                        ->take(6)
                        ->get();

        return view('customers.home.index', compact('fields'));
    }
}
