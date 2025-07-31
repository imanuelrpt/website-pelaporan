<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminLaporanController extends Controller
{
    public function export()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }
    public function index() {
        $laporans = Laporan::paginate(10);
        return view('admin.laporan.index', compact('laporans'));
    }
    public function show(Laporan $laporan) {
        return view('admin.laporan.show', compact('laporan'));
    }
    public function updateStatus(Request $request, Laporan $laporan) {
        $request->validate(['status' => 'required|in:Diterima,Sedang Diproses,Selesai,Ditolak']);
        $laporan->update(['status' => $request->status]);
        // Notifikasi ke user bisa ditambahkan di sini
        return back()->with('success', 'Status laporan diperbarui');
    }
    public function tanggapan(Request $request, Laporan $laporan) {
        $request->validate(['isi_tanggapan' => 'required']);
        Tanggapan::create([
            'laporan_id' => $laporan->id,
            'admin_id' => Auth::id(),
            'isi_tanggapan' => $request->isi_tanggapan
        ]);
        // Notifikasi ke user bisa ditambahkan di sini
        return back()->with('success', 'Tanggapan berhasil dikirim');
    }
}
