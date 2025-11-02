<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // ambil semua data mahasiswa
        return Mahasiswa::select('nama', 'nim', 'email')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'NIM', 'Email'];
    }
}
