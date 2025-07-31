<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'judul', 'deskripsi', 'foto', 'status', 'latitude', 'longitude'
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function tanggapans() { return $this->hasMany(Tanggapan::class); }

    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'Diterima':
                return 'success';
            case 'Sedang Diproses':
                return 'info';
            case 'Selesai':
                return 'primary';
            case 'Ditolak':
                return 'danger';
            default:
                return 'secondary';
        }
    }
}
