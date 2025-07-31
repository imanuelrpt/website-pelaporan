<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $laporans = Laporan::where('user_id', Auth::id())->paginate(10);
        return view('laporan.index', compact('laporans'));
    }
    public function create() {
        return view('laporan.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan_foto', 'public');
        }
        $data['user_id'] = Auth::id();
        Laporan::create($data);
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim');
    }
    public function show(Laporan $laporan) {
        // Pastikan hanya pemilik laporan yang bisa melihat detailnya
        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }
        $laporan->load('tanggapans.admin');
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa mengedit
        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa mengupdate
        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate laporan ini.');
        }

        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $data['foto'] = $request->file('foto')->store('laporan_foto', 'public');
        } else {
            // Pertahankan foto lama jika tidak ada foto baru diupload
            $data['foto'] = $laporan->foto;
        }

        $laporan->update($data);

        return redirect()->route('laporan.show', $laporan)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        // Pastikan hanya pemilik laporan yang bisa menghapus
        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus laporan ini.');
        }

        // Hapus foto terkait jika ada
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}