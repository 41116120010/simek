<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Event</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        h1 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Daftar Event</h1>
    <p>Generated: {{ date('d/m/Y H:i') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Event</th>
                <th>Tipe</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Registrasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->code }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->type === 'competition' ? 'Lomba' : 'Seminar' }}</td>
                    <td>{{ ucfirst($event->status) }}</td>
                    <td>{{ $event->start_date->format('d/m/Y') }}</td>
                    <td>{{ $event->registrations_count }}/{{ $event->quota ?? '∞' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>