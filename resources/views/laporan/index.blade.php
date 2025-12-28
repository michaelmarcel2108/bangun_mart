<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan BangunMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container bg-white p-4 shadow-sm rounded">
        <h2 class="text-center mb-4">📊 Dashboard Laporan BangunMart</h2>
        
        <div class="row">
            <div class="col-md-12 mb-5">
                <h4 class="text-danger">⚠️ Stok Menipis (Butuh Re-order)</h4>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Stok Sisa</th>
                            <th>Minimum</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMenipis as $s)
                        <tr>
                            <td>{{ $s->nama_produk }}</td>
                            <td>{{ $s->nama_kategori }}</td>
                            <td class="fw-bold text-danger">{{ $s->stok }}</td>
                            <td>{{ $s->stok_minimum }}</td>
                            <td>{{ $s->nama_satuan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 mb-4">
                <h4>🏆 10 Produk Terlaris</h4>
                <ul class="list-group">
                    @foreach($terlaris as $t)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $t->nama_produk }}
                        <span class="badge bg-primary rounded-pill">{{ $t->total_qty }} terjual</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h4>👥 Daftar Kontak (Union)</h4>
                <table class="table table-sm table-hover">
                    <thead>
                        <tr><th>Nama</th><th>Tipe</th></tr>
                    </thead>
                    <tbody>
                        @foreach($kontak as $k)
                        <tr><td>{{ $k->nama }}</td><td><span class="badge bg-secondary">{{ $k->tipe }}</span></td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h4>📈 Rekap Penjualan Harian</h4>
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr><th>Tanggal</th><th>Total Omzet</th></tr>
                    </thead>
                    <tbody>
                        @foreach($rekapBulanan as $r)
                        <tr>
                            <td>{{ date('d M Y', strtotime($r->tanggal)) }}</td>
                            <td>Rp {{ number_format($r->total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>