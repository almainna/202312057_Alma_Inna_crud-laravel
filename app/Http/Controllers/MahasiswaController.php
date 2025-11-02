<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    // ✅ Menampilkan daftar mahasiswa + Pencarian + Pagination
    public function index(Request $request)
    {
        // Ambil input pencarian (jika ada)
        $search = $request->input('search');

        // Query mahasiswa dengan filter pencarian
        $mahasiswa = Mahasiswa::when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('nim', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('nama', 'asc')
            ->paginate(5) // ✅ Tampilkan 5 data per halaman
            ->appends(['search' => $search]); // ✅ Agar pagination tetap membawa kata pencarian

        // Kirim data ke view
        return view('mahasiswa.index', compact('mahasiswa', 'search'));
    }

    // ✅ Menampilkan form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }

    // ✅ Menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'email' => 'required|email|unique:mahasiswas,email',
        ]);

        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // ✅ Menampilkan form edit mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // ✅ Mengupdate data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // ✅ Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // ✅ Cetak PDF
    public function cetakPDF()
    {
        $mahasiswa = Mahasiswa::all();

        $pdf = Pdf::loadView('mahasiswa.cetak_pdf', ['mahasiswa' => $mahasiswa])
                  ->setPaper('a4', 'portrait');

        return $pdf->download('daftar_mahasiswa.pdf');
    }
}
