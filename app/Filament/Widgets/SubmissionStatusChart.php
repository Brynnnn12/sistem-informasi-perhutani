<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Pengajuan';

    protected static ?int $sort = 3;

    public static function canView(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    protected function getData(): array
    {
        $data = Submission::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengajuan',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#f59e0b', // warning (pending)
                        '#10b981', // success (approved)
                        '#ef4444', // danger (rejected)
                    ],
                ],
            ],
            'labels' => [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
