<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // 👇 Sesuaikan dengan nama tabel di database kamu
    protected $table = 'mahasiswas';

    protected $fillable = [
        'nama',
        'nim',
        'email',
    ];
}
