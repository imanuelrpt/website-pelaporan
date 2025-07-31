<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Laporan::with('user')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Deskripsi',
            'Status',
            'Pelapor',
            'Tanggal Dibuat',
        ];
    }

    /**
    * @param mixed $laporan
    *
    * @return array
    */
    public function map($laporan): array
    {
        return [
            $laporan->id,
            $laporan->judul,
            $laporan->deskripsi,
            $laporan->status,
            $laporan->user->name,
            $laporan->created_at->format('d-m-Y'),
        ];
    }
}
