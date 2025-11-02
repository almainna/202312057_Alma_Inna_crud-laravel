<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f7fa;
      color: #2c3e50;
      font-family: 'Segoe UI', sans-serif;
    }

    h1 {
      color: #2c3e50;
      font-weight: 600;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    /* HEADER TABEL TANPA WARNA */
    .table thead th {
      font-weight: 600;
      border-bottom: 2px solid #dee2e6;
      background-color: transparent;
      color: #2c3e50;
    }

    /* ISI TABEL TANPA LATAR */
    .table tbody td {
      background-color: transparent !important;
      color: #2c3e50;
      font-weight: 500;
      vertical-align: middle;
    }

    /* Baris zebra halus */
    .table tbody tr:nth-child(odd) { background-color: #ffffff; }
    .table tbody tr:nth-child(even) { background-color: #f9f9f9; }
    .table tbody tr:hover { background-color: #f1f5ff; transition: 0.2s; }

    /* Tombol */
    .btn-primary { background-color: #1f3c88; border: none; }
    .btn-primary:hover { background-color: #162d66; }
    .btn-success { background-color: #27ae60; border: none; }
    .btn-success:hover { background-color: #1e874b; }
    .btn-danger { background-color: #c0392b; border: none; }
    .btn-danger:hover { background-color: #992d22; }
    .btn-edit { background-color: #1f3c88; border: none; color: white; }
    .btn-edit:hover { background-color: #162d66; color: white; }

    /* Pagination */
    .pagination .page-link { color: #1f3c88; }
    .pagination .active .page-link { background-color: #1f3c88; border-color: #1f3c88; }
  </style>
</head>
<body>
  <div class="container py-5">
    <h1 class="h3 mb-4">📋 Daftar Mahasiswa</h1>

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
      <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex mb-2 mb-md-0">
        <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="Cari nama / NIM / email">
        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
      </form>

      <div class="d-flex gap-2">
        <a href="{{ route('mahasiswa.export') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
        <a href="{{ route('mahasiswa.cetakPDF') }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah</a>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-hover align-middle text-center">
          <thead>
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th>Email</th>
              <th width="150">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($mahasiswa as $m)
            <tr>
              <td>{{ $m->nama }}</td>
              <td>{{ $m->nim }}</td>
              <td>{{ $m->email }}</td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-edit btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                  </a>
                  <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-4">Belum ada data mahasiswa.</td>
            </tr>
            @endforelse
          </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
          <p class="text-muted small mb-0">
            Menampilkan {{ $mahasiswa->firstItem() }} - {{ $mahasiswa->lastItem() }} dari {{ $mahasiswa->total() }} data
          </p>
          {{ $mahasiswa->links() }}
        </div>
      </div>
    </div>
  </div>
</body>
</html>
