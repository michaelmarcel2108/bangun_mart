<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Nota #{{ $penjualan->id_nota }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 80mm; margin: 0 auto; padding: 10px; }
        .text-center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        .text-right { text-align: right; }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h2 style="margin:0;">BANGUNMART</h2>
        <p style="font-size: 12px; margin:0;">Solusi Bahan Bangunan Anda</p>
    </div>

    <div class="line"></div>
    
    <table style="font-size: 12px;">
        <tr>
            <td>No Nota:</td>
            <td class="text-right">#{{ $penjualan->id_nota }}</td> </tr>
        <tr>
            <td>Kasir:</td>
            <td class="text-right">{{ $penjualan->nama_pegawai }}</td>
        </tr>
        <tr>
            <td>Tanggal:</td>
            <td class="text-right">{{ date('d/m/Y H:i', strtotime($penjualan->tgl_nota)) }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table style="font-size: 12px;">
        <thead>
            <tr>
                <th align="left">Item</th>
                <th align="center">Qty</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $item)
            <tr>
                <td>{{ $item->nama_produk }}</td>
                <td align="center">{{ $item->qty }}</td>
                <td align="right">{{ number_format($item->subtotal ?? ($item->qty * $item->harga_satuan), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="line"></div>

    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td>TOTAL:</td>
            <td class="text-right">Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>
    <div class="text-center" style="font-size: 10px; margin-top: 10px;">
        Terima Kasih Atas Kunjungan Anda<br>
        Barang yang sudah dibeli tidak dapat ditukar/dikembalikan
    </div>

    <div style="margin-top: 20px;" class="text-center">
        <a href="{{ route('penjualan.index') }}" style="text-decoration: none; color: blue; font-size: 12px;">[ Kembali ke Kasir ]</a>
    </div>
</body>
</html>