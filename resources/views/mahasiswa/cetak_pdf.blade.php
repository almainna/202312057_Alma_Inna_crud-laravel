<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Mahasiswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>📋 Daftar Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $m)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align:right; margin-top:20px;">
        Dicetak pada: {{ now()->format('d/m/Y H:i') }}
    </p>
</body>
</html>
