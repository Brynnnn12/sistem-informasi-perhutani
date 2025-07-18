<?php

namespace App\Filament\Widgets;

use App\Models\Forest;
use App\Models\Plant;
use App\Models\Report;
use App\Models\Submission;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        // Initialize stats as an empty array
        $stats = [];

        if ($user?->hasAnyRole(['admin', 'petugas'])) {
            // Stats for admin and petugas
            $stats[] = Stat::make('Total Hutan', Forest::count())
                ->description('Jumlah lokasi hutan yang terdaftar')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('success');

            $stats[] = Stat::make('Total Tanaman', Plant::count())
                ->description('Jumlah tanaman yang tercatat')
                ->descriptionIcon('heroicon-m-beaker')
                ->color('info');

            // Only add 'Total Pengguna' stat if the user is an admin
            if ($user?->hasRole('admin')) {
                $stats[] = Stat::make('Total Pengguna', User::count())
                    ->description('Jumlah pengguna terdaftar')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('warning');
            }

            $stats[] = Stat::make('Pengajuan Pending', Submission::where('status', 'pending')->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger');

            // Admin and petugas see all reports
            $stats[] = Stat::make('Laporan Masuk', Report::where('status', 'pending')->count())
                ->description('Laporan yang belum ditindaklanjuti')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger');

            $stats[] = Stat::make('Laporan Selesai', Report::where('status', 'resolved')->count())
                ->description('Laporan yang sudah diselesaikan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success');
        } else {
            // Public users (masyarakat) only see their own reports and submissions
            $stats[] = Stat::make('Laporan Saya', Report::where('user_id', $user->id)->count())
                ->description('Total laporan yang saya buat')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info');

            $stats[] = Stat::make('Pengajuan Saya', Submission::where('user_id', $user->id)->count())
                ->description('Total pengajuan yang saya buat')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color('warning');
        }

        return $stats; // No need for array_filter if you conditionally add them
    }
}
