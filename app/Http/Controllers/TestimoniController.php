<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function create()
    {
        return view('testimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'testimoni' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $existingTestimoni = Testimoni::where('user_id', Auth::id())->first();
        if ($existingTestimoni) {
            return redirect()->route('home')->with('error', 'Anda sudah pernah memberikan testimoni.');
        }

        Testimoni::create([
            'user_id' => Auth::id(),
            'testimoni' => $request->testimoni,
            'rating' => $request->rating,
            'is_visible' => true, // Langsung tampilkan testimoni
        ]);

        return redirect()->route('home')->with('success', 'Terima kasih atas testimoni Anda!');
    }
}
