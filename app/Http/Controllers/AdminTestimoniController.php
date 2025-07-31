<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminTestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::with('user')->latest()->paginate(10);
        return view('admin.testimoni.index', compact('testimonis'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $testimoni->update(['is_visible' => $request->is_visible]);
        return back()->with('success', 'Status testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
