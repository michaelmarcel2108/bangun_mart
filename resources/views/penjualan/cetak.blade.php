<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Nota #{{ $penjualan->id_nota }}</title>
    <style>
        /* Konfigurasi Dasar Struk 80mm */
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; 
            width: 80mm; 
            margin: 0 auto; 
            padding: 20px 10px; 
            background-color: #ffffff;
            color: #0F172A; /* construction-black */
        }

        /* Tipografi Industrial */
        .brand { 
            background-color: #0F172A; 
            color: #FACC15; /* construction-yellow */
            padding: 10px; 
            text-align: center; 
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .brand h2 { margin: 0; font-size: 22px; font-weight: 900; letter-spacing: -1px; }
        .brand p { margin: 0; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; }

        /* Garis Pemisah ala Konstruksi */
        .divider { 
            border-top: 3px double #0F172A; 
            margin: 15px 0; 
        }
        .line-dashed { 
            border-top: 1px dashed #cbd5e1; 
            margin: 8px 0; 
        }

        /* Tabel Data & Item */
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        .metadata td { padding: 2px 0; font-weight: 600; color: #64748b; }
        .metadata .value { text-align: right; color: #0F172A; font-family: 'Courier New', Courier, monospace; }

        .items th { 
            text-align: left; 
            padding: 8px 0; 
            border-bottom: 2px solid #0F172A; 
            text-transform: uppercase; 
            font-size: 10px; 
            letter-spacing: 1px;
        }
        .items td { padding: 8px 0; vertical-align: top; }
        .items .price { text-align: right; font-family: 'Courier New', Courier, monospace; font-weight: 700; }

        /* Total Section */
        .total-box { 
            background-color: #FACC15; 
            padding: 10px; 
            margin-top: 10px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-label { font-weight: 900; font-size: 12px; text-transform: uppercase; }
        .total-amount { font-weight: 900; font-size: 16px; font-family: 'Courier New', Courier, monospace; }

        /* Footer & Aksi */
        .footer { text-align: center; font-size: 9px; margin-top: 20px; color: #94a3b8; font-weight: 600; }
        .back-link { 
            display: block; 
            text-align: center; 
            margin-top: 30px; 
            text-decoration: none; 
            color: #0F172A; 
            font-size: 11px; 
            font-weight: 800;
            text-transform: uppercase;
            border: 2px solid #0F172A;
            padding: 8px;
            border-radius: 6px;
        }
        
        /* Hilangkan elemen saat print */
        @media print {
            .back-link { display: none; }
            body { padding: 0; margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="brand">
        <h2>BANGUNMART</h2>
        <p>Industrial Supply</p>
    </div>

    <table class="metadata">
        <tr>
            <td>ID NOTA</td>
            <td class="value">#{{ $penjualan->id_nota }}</td>
        </tr>
        <tr>
            <td>OPERATOR</td>
            <td class="value">{{ strtoupper($penjualan->nama_pegawai) }}</td>
        </tr>
        <tr>
            <td>TANGGAL</td>
            <td class="value">{{ date('d.m.Y / H:i', strtotime($penjualan->tgl_nota)) }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <table class="items">
        <thead>
            <tr>
                <th width="50%">MATERIAL</th>
                <th width="15%" style="text-align: center;">QTY</th>
                <th width="35%" style="text-align: right;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $item)
            <tr>
                <td>
                    <div style="font-weight: 800;">{{ strtoupper($item->nama_produk) }}</div>
                    <div style="font-size: 9px; color: #94a3b8;">Harga: {{ number_format($item->harga_satuan, 0, ',', '.') }}</div>
                </td>
                <td align="center" style="font-weight: 700;">{{ $item->qty }}</td>
                <td class="price">
                    {{ number_format($item->subtotal ?? ($item->qty * $item->harga_satuan), 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="line-dashed"></div>

    <div class="total-box">
        <span class="total-label">TOTAL AKHIR</span>
        <span class="total-amount">Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</span>
    </div>

    <div class="footer">
        *** TERIMA KASIH ATAS KEPERCAYAAN ANDA ***<br>
        BARANG YANG SUDAH DIBELI TIDAK DAPAT DITUKAR/DIKEMBALIKAN<br>
        <span style="color: #0F172A; margin-top: 5px; display: block;">WWW.BANGUNMART.COM</span>
    </div>

    <a href="{{ route('penjualan.index') }}" class="back-link">
        &larr; KEMBALI KE TERMINAL KASIR
    </a>
</body>
</html>