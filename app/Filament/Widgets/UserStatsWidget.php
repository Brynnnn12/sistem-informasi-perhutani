<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use App\Models\Submission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('masyarakat') ?? false;
    }

    protected function getStats(): array
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $totalReports = Report::where('user_id', $user->id)->count();
        $pendingReports = Report::where('user_id', $user->id)->where('status', 'pending')->count();
        $resolvedReports = Report::where('user_id', $user->id)->where('status', 'resolved')->count();

        $totalSubmissions = Submission::where('user_id', $user->id)->count();
        $pendingSubmissions = Submission::where('user_id', $user->id)->where('status', 'pending')->count();
        $approvedSubmissions = Submission::where('user_id', $user->id)->where('status', 'approved')->count();

        return [
            Stat::make('Total Laporan Saya', $totalReports)
                ->description('Laporan yang sudah saya buat')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Laporan Pending', $pendingReports)
                ->description('Menunggu tindak lanjut')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Laporan Selesai', $resolvedReports)
                ->description('Sudah ditindaklanjuti')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total Pengajuan Saya', $totalSubmissions)
                ->description('Pengajuan yang sudah saya buat')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color('info')
                ->chart([3, 5, 2, 7, 4, 6, 8, 2]),

            Stat::make('Pengajuan Pending', $pendingSubmissions)
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Pengajuan Disetujui', $approvedSubmissions)
                ->description('Sudah disetujui')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
