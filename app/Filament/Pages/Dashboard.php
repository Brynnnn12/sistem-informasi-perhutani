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
        $widgets = [];

        if ($user?->hasRole('masyarakat')) {
            // Widget untuk masyarakat
            $widgets = [
                \App\Filament\Widgets\UserStatsWidget::class,
                \App\Filament\Widgets\RecentActivitiesWidget::class,
            ];
        } else {
            // Widget untuk admin dan petugas
            $widgets = [
                \App\Filament\Widgets\StatsOverviewWidget::class,
                \App\Filament\Widgets\ReportStatusChart::class,
                \App\Filament\Widgets\SubmissionStatusChart::class,
                \App\Filament\Widgets\MonthlyActivityChart::class,
                \App\Filament\Widgets\ForestTypeChart::class,
                \App\Filament\Widgets\ForestOverviewWidget::class,
                \App\Filament\Widgets\RecentActivitiesWidget::class,
            ];
        }

        return $widgets;
    }

    public function getColumns(): int | string | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 3,
        ];
    }
}
