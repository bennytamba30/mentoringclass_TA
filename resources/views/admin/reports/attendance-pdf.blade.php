<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Absensi Mentoring</h2>


    <table>
        <thead>
            <tr>
                <th>Pertemuan</th>
                <th>Mentee</th>
                <th>Mentor</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Waktu Input</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
            <tr>
                <td>{{ $attendance->meeting->title ?? '-' }}</td>
                <td>{{ $attendance->mentee->name ?? '-' }}</td>
                <td>{{ $attendance->mentee->mentor->name ?? '-' }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>{{ $attendance->note ?? '-' }}</td>
                <td>{{ $attendance->created_at?->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
