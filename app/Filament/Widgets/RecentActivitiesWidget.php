<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class RecentActivitiesWidget extends BaseWidget
{
    protected static ?string $heading = 'Laporan Terbaru';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = Auth::user();
        return $user?->hasAnyRole(['admin', 'petugas', 'masyarakat']) ?? false;
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $user = Auth::user();

        if ($user?->hasAnyRole(['admin', 'petugas'])) {
            // Admin dan petugas melihat semua laporan terbaru
            return Report::with('user', 'forest')->latest();
        } else {
            // Masyarakat hanya melihat laporan sendiri
            return Report::with('user', 'forest')->where('user_id', $user->id)->latest();
        }
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->label('Judul Laporan')
                ->searchable()
                ->limit(40),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Pelapor')
                ->searchable(),

            Tables\Columns\TextColumn::make('forest.name')
                ->label('Lokasi Hutan')
                ->searchable(),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => 'pending',
                    'info' => 'in_progress',
                    'success' => 'resolved',
                ])
                ->formatStateUsing(function (string $state): string {
                    return match ($state) {
                        'pending' => 'Menunggu',
                        'in_progress' => 'Dalam Proses',
                        'resolved' => 'Selesai',
                        default => $state,
                    };
                }),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime()
                ->sortable(),
        ];
    }
}
