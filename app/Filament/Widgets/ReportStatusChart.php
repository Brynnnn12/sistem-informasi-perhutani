<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Laporan';

    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    protected function getData(): array
    {
        $data = Report::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#f59e0b', // warning (pending)
                        '#3b82f6', // info (in_progress)
                        '#10b981', // success (resolved)
                    ],
                ],
            ],
            'labels' => [
                'Menunggu',
                'Dalam Proses',
                'Selesai'
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
