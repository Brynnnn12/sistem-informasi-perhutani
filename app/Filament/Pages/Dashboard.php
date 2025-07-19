<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';

    public function getWidgets(): array
    {
        $user = Auth::user();

        if ($user?->hasRole('masyarakat')) {
            // Dashboard dengan grafik untuk masyarakat
            return [
                \App\Filament\Widgets\UserStatsWidget::class,
                \App\Filament\Widgets\RecentActivitiesWidget::class,
            ];
        } else {
            // Dashboard dengan chart untuk admin dan petugas (tanpa stats status)
            return [
                \App\Filament\Widgets\UserStatsWidget::class,
                \App\Filament\Widgets\ReportStatusChart::class,
                \App\Filament\Widgets\SubmissionStatusChart::class,
            ];
        }
    }

    public function getColumns(): int | string | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 2, // Maksimal 2 kolom
        ];
    }
}
