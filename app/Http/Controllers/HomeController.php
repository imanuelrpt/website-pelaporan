<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::where('is_visible', true)->latest()->get();
        return view('home', compact('testimonis'));
    }
}
