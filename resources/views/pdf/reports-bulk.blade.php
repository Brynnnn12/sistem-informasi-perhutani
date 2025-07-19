<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Kejadian Hutan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            font-size: 6px;
            padding: 3px;
        }

        .header {
            text-align: center;
            margin-bottom: 3px;
        }

        .header h1 {
            font-size: 8px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 5px;
        }

        th {
            background: #333;
            color: white;
            padding: 1px;
            border: 1px solid #ddd;
        }

        td {
            padding: 1px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .status {
            padding: 1px;
            border-radius: 1px;
            font-size: 4px;
            font-weight: bold;
        }

        .status.pending {
            background: #FEF3C7;
            color: #D97706;
        }

        .status.in_progress {
            background: #DBEAFE;
            color: #1D4ED8;
        }

        .status.resolved {
            background: #D1FAE5;
            color: #059669;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN KEJADIAN HUTAN</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="25%">Judul</th>
                <th width="12%">Pelapor</th>
                <th width="15%">Lokasi</th>
                <th width="8%">Status</th>
                <th width="12%">Tgl Laporan</th>
                <th width="12%">Tgl Verifikasi</th>
                <th width="13%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $report->title }}</strong></td>
                    <td>{{ $report->user?->name ?? 'N/A' }}</td>
                    <td>{{ $report->forest?->name ?? 'N/A' }}</td>
                    <td>
                        <span class="status {{ $report->status }}">
                            @if ($report->status == 'pending')
                                MENUNGGU
                            @elseif($report->status == 'in_progress')
                                PROSES
                            @elseif($report->status == 'resolved')
                                SELESAI
                            @else
                                {{ strtoupper($report->status) }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $report->reported_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $report->verified_at ? $report->verified_at->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ Str::limit($report->description, 60) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
