<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute utama untuk resource Mahasiswa beserta fitur tambahan seperti
| Cetak PDF dan Export Excel.
| Pastikan route khusus (PDF/Excel) dideklarasikan SEBELUM route resource
| agar tidak tertangkap oleh parameter {id} milik route show().
|
*/

// 🔹 Route untuk cetak PDF (HARUS DI ATAS)
Route::get('/mahasiswa/cetak-pdf', [MahasiswaController::class, 'cetakPDF'])
    ->name('mahasiswa.cetakPDF');

// 🔹 Route untuk export Excel (HARUS DI ATAS)
Route::get('/mahasiswa/export', function () {
    return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
})->name('mahasiswa.export');

// 🔹 Route CRUD otomatis (index, create, store, edit, update, destroy, show)
Route::resource('mahasiswa', MahasiswaController::class);
