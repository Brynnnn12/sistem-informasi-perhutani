<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use App\Models\Submission;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MonthlyActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Aktivitas Bulanan';

    protected static ?int $sort = 4;

    public static function canView(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        });

        $reportData = Report::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $submissionData = Submission::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $reportCounts = [];
        $submissionCounts = [];

        for ($i = 1; $i <= 12; $i++) {
            $reportCounts[] = $reportData[$i] ?? 0;
            $submissionCounts[] = $submissionData[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Laporan',
                    'data' => $reportCounts,
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                ],
                [
                    'label' => 'Pengajuan',
                    'data' => $submissionCounts,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
