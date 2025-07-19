<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengajuan</title>
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

        .status.approved {
            background: #D1FAE5;
            color: #059669;
        }

        .status.rejected {
            background: #FEE2E2;
            color: #DC2626;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PENGAJUAN PEMANFAATAN HUTAN</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="25%">Judul</th>
                <th width="12%">Pemohon</th>
                <th width="8%">Status</th>
                <th width="15%">Tgl Pengajuan</th>
                <th width="15%">Tgl Disetujui</th>
                <th width="22%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($submissions as $index => $submission)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $submission->title }}</strong></td>
                    <td>{{ $submission->user?->name ?? 'N/A' }}</td>
                    <td>
                        <span class="status {{ $submission->status }}">
                            @if ($submission->status == 'pending')
                                MENUNGGU
                            @elseif($submission->status == 'approved')
                                DISETUJUI
                            @elseif($submission->status == 'rejected')
                                DITOLAK
                            @else
                                {{ strtoupper($submission->status) }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $submission->submitted_at ? $submission->submitted_at->format('d/m/Y H:i') : $submission->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td>{{ $submission->approved_at ? $submission->approved_at->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ Str::limit($submission->description, 60) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
font-size: 8px;
}

.stat-label {
font-size: 6px;
color: #666;
}

table {
width: 100%;
border-collapse: collapse;
font-size: 6px;
}

th {
background: #333;
color: white;
padding: 2px;
border: 1px solid #ddd;
}

td {
padding: 1px 2px;
border: 1px solid #ddd;
vertical-align: top;
}

tr:nth-child(even) {
background: #f9f9f9;
}

.status {
padding: 1px 2px;
border-radius: 2px;
font-size: 5px;
font-weight: bold;
}

.status.pending {
background: #FEF3C7;
color: #D97706;
}

.status.approved {
background: #D1FAE5;
color: #059669;
}

.status.rejected {
background: #FEE2E2;
color: #DC2626;
}

.footer {
margin-top: 5px;
text-align: center;
font-size: 6px;
color: #666;
}
</style>
</head>

<body>
    <div class="header">
        <h1>SISTEM INFORMASI PERHUTANI</h1>
        <h2>Laporan Pengajuan Pemanfaatan Hutan</h2>
        <div style="font-size: 6px;">{{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="summary">
        <div class="stat">
            <div class="stat-num">{{ $submissions->count() }}</div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $submissions->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $submissions->where('status', 'approved')->count() }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $submissions->where('status', 'rejected')->count() }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="25%">Judul</th>
                <th width="15%">Pemohon</th>
                <th width="8%">Status</th>
                <th width="12%">Tgl Pengajuan</th>
                <th width="12%">Tgl Disetujui</th>
                <th width="25%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($submissions as $index => $submission)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $submission->title }}</strong></td>
                    <td>{{ $submission->user?->name ?? 'N/A' }}</td>
                    <td>
                        <span class="status {{ $submission->status }}">
                            @if ($submission->status == 'pending')
                                MENUNGGU
                            @elseif($submission->status == 'approved')
                                DISETUJUI
                            @elseif($submission->status == 'rejected')
                                DITOLAK
                            @else
                                {{ strtoupper($submission->status) }}
                            @endif
                        </span>
                    </td>
                    <td>{{ $submission->submitted_at ? $submission->submitted_at->format('d/m/Y H:i') : $submission->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td>{{ $submission->approved_at ? $submission->approved_at->format('d/m/Y H:i') : '-' }}</td>
                    <td>{{ Str::limit($submission->description, 100) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <strong>Sistem Informasi Perhutani</strong> |
        Total {{ $submissions->count() }} pengajuan |
        {{ now()->format('d/m/Y H:i:s') }} |
        © {{ date('Y') }}
    </div>
</body>

</html>
