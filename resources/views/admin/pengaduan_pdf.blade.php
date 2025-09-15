<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengaduan Masyarakat</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #888; padding: 6px; text-align: left; }
        th { background: #f3e8ff; }
        .badge {
            padding: 2px 8px;
            border-radius: 8px;
            font-size: 11px;
            color: #fff;
        }
        .badge-gray { background: #888; }
        .badge-yellow { background: #fbbf24; }
        .badge-green { background: #22c55e; }
    </style>
</head>
<body>
    <h2 style="color:#a21caf;">Data Pengaduan Masyarakat</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Isi Laporan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduans as $p)
            <tr>
                <td>{{ $p->tgl_pengaduan }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->isi_laporan }}</td>
                <td>
                    @if($p->status == 'selesai')
                        <span class="badge badge-green">Selesai</span>
                    @elseif($p->status == 'proses')
                        <span class="badge badge-yellow">Proses</span>
                    @else
                        <span class="badge badge-gray">Belum direspon</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
