<?php

namespace App\Filament\Widgets;

use App\Models\Forest;
use App\Models\Plant;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class ForestOverviewWidget extends BaseWidget
{
    protected static ?string $heading = 'Ringkasan Hutan';

    protected static ?int $sort = 5;

    public static function canView(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Forest::query()
            ->withCount('plants')
            ->orderBy('area_size', 'desc')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Nama Hutan')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('location')
                ->label('Lokasi')
                ->limit(30),

            Tables\Columns\TextColumn::make('area_size')
                ->label('Luas (Ha)')
                ->numeric()
                ->sortable()
                ->suffix(' Ha'),

            Tables\Columns\TextColumn::make('plants_count')
                ->label('Jumlah Tanaman')
                ->numeric()
                ->sortable(),

            Tables\Columns\BadgeColumn::make('forest_type')
                ->label('Jenis')
                ->colors([
                    'success' => 'konservasi',
                    'warning' => 'produksi',
                    'info' => 'lindung',
                    'danger' => 'wisata',
                ])
                ->formatStateUsing(function (string $state): string {
                    return match ($state) {
                        'konservasi' => 'Konservasi',
                        'produksi' => 'Produksi',
                        'lindung' => 'Lindung',
                        'wisata' => 'Wisata',
                        default => $state,
                    };
                }),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('Lihat')
                ->icon('heroicon-o-eye')
                ->url(fn(Forest $record): string => url("/admin/forests/{$record->id}")),
        ];
    }
}
