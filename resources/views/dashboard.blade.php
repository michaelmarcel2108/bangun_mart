<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BangunMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card-menu { transition: all 0.3s; border: none; }
        .card-menu:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .btn-logout { border: none; background: none; padding: 0; width: 100%; text-align: center; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
    <div class="container">
        <span class="navbar-brand font-weight-bold">🏗️ BangunMart POS</span>
        <div class="ms-auto text-white">
            <i class="fa fa-user-circle"></i> {{ auth()->user()->name }} 
            <span class="badge bg-primary ms-2">{{ ucfirst(auth()->user()->jabatan) }}</span>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <h2 class="mb-4 fw-bold text-dark">Ringkasan Toko</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4 shadow border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase small">Total Produk</h6>
                            <h2 class="fw-bold">{{ $totalProduk }} Item</h2>
                        </div>
                        <i class="fa fa-boxes fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a class="text-white text-decoration-none small" href="{{ route('produk.index') }}">
                        Kelola Stok <i class="fa fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white mb-4 shadow border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase small">Stok Kritis</h6>
                            <h2 class="fw-bold">{{ $stokKritis }} Produk</h2>
                        </div>
                        <i class="fa fa-exclamation-triangle fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-white small">
                    Segera lakukan restock ke supplier
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white mb-4 shadow border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase small">Omzet Hari Ini</h6>
                            <h2 class="fw-bold">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
                        </div>
                        <i class="fa fa-wallet fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-white small">
                    Terakhir diupdate: {{ date('H:i') }} WIB
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 mb-4 rounded-3">
        <div class="card-header bg-white py-3 fw-bold text-secondary">
            <i class="fa fa-rocket me-2"></i> JEMBATAN TRANSAKSI & NAVIGASI
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <a href="{{ route('penjualan.index') }}" class="card card-menu bg-light p-4 text-decoration-none text-center">
                        <i class="fa fa-shopping-cart fa-3x text-indigo mb-3 text-primary"></i>
                        <h6 class="fw-bold text-dark mb-0">Kasir</h6>
                        <small class="text-muted text-xs">Buat Nota Baru</small>
                    </a>
                </div>

                @if(auth()->user()->jabatan == 'admin')
                <div class="col-6 col-md-3">
                    <a href="{{ route('produk.index') }}" class="card card-menu bg-light p-4 text-decoration-none text-center">
                        <i class="fa fa-database fa-3x text-success mb-3"></i>
                        <h6 class="fw-bold text-dark mb-0">Master Data</h6>
                        <small class="text-muted text-xs">Produk & Stok</small>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="#" class="card card-menu bg-light p-4 text-decoration-none text-center">
                        <i class="fa fa-file-invoice-dollar fa-3x text-info mb-3"></i>
                        <h6 class="fw-bold text-dark mb-0">Laporan</h6>
                        <small class="text-muted text-xs">Rekap Penjualan</small>
                    </a>
                </div>
                @endif

                <div class="col-6 col-md-3">
                    <form method="POST" action="{{ route('logout') }}" class="h-100">
                        @csrf
                        <button type="submit" class="card card-menu bg-light p-4 text-center w-100">
                            <i class="fa fa-sign-out-alt fa-3x text-danger mb-3"></i>
                            <h6 class="fw-bold text-dark mb-0">Logout</h6>
                            <small class="text-muted text-xs">Keluar Sistem</small>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold text-secondary"><i class="fa fa-history me-2"></i> 5 TRANSAKSI TERAKHIR</span>
            <span class="badge bg-secondary">Riwayat Nota</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No Nota</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerakhir as $t)
                        <tr>
                            <td class="fw-bold text-primary">#{{ str_pad($t->id_nota, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ date('d M Y', strtotime($t->tgl_nota)) }}</td>
                            <td><span class="fw-bold text-dark">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('penjualan.cetak', $t->id_nota) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa fa-print me-1"></i> Cetak Nota
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>