<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Report - {{ now()->format('Y-m-d') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #333;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #4F46E5;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid {
            background-color: #DEF7EC;
            color: #03543F;
        }
        .status-unpaid {
            background-color: #FEF3C7;
            color: #92400E;
        }
        .status-expired {
            background-color: #FEE2E2;
            color: #991B1B;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .total-revenue {
            font-size: 18px;
            color: #10B981;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN PEMBAYARAN</h1>
        <p>SIMEK - Sistem Manajemen Event & Kompetisi</p>
        <p>Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Summary Statistics -->
    <div class="summary">
        <div class="summary-item">
            <span>Total Transaksi:</span>
            <span>{{ $payments->count() }}</span>
        </div>
        <div class="summary-item">
            <span>Pembayaran Berhasil:</span>
            <span>{{ $payments->where('status', 'paid')->count() }}</span>
        </div>
        <div class="summary-item">
            <span>Menunggu Pembayaran:</span>
            <span>{{ $payments->where('status', 'unpaid')->count() }}</span>
        </div>
        <div class="summary-item total-revenue">
            <span>Total Revenue:</span>
            <span>Rp {{ number_format($payments->where('status', 'paid')->sum('amount'), 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Payment Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Reference</th>
                <th style="width: 20%;">Peserta</th>
                <th style="width: 25%;">Event</th>
                <th style="width: 15%;">Amount</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-family: 'Courier New', monospace; font-size: 10px;">
                        {{ $payment->reference }}
                    </td>
                    <td>
                        <strong>{{ $payment->registration->user->name }}</strong><br>
                        <small style="color: #666;">{{ $payment->registration->user->email }}</small>
                    </td>
                    <td>{{ $payment->registration->event->name }}</td>
                    <td>
                        <strong>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</strong>
                        @if($payment->payment_channel)
                            <br><small style="color: #666;">{{ $payment->payment_channel }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="status status-{{ $payment->status }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem SIMEK</p>
        <p>&copy; {{ now()->year }} SIMEK - Sistem Manajemen Event & Kompetisi</p>
    </div>
</body>
</html>