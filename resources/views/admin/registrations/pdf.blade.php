<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Data Registrasi Event</h1>
    <p>Tanggal Export: {{ now()->format('d F Y, H:i') }}</p>
    <p>Total Registrasi: {{ $registrations->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Event</th>
                <th>Peserta</th>
                <th>Institusi</th>
                <th>Tim</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $index => $registration)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $registration->registration_code }}</td>
                <td>{{ $registration->event->name }}</td>
                <td>
                    {{ $registration->user->name }}<br>
                    <small>{{ $registration->user->email }}</small>
                </td>
                <td>{{ $registration->user->institution }}</td>
                <td>{{ $registration->team_name ?? '-' }}</td>
                <td class="text-center">{{ ucfirst($registration->status) }}</td>
                <td>{{ $registration->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>