<?php

namespace App\Filament\Widgets;

use App\Models\Forest;
use App\Models\Plant;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ForestTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Jenis Hutan';

    protected static ?int $sort = 7;

    public static function canView(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    protected function getData(): array
    {
        $forestTypes = Forest::selectRaw('forest_type, COUNT(*) as count')
            ->groupBy('forest_type')
            ->pluck('count', 'forest_type')
            ->toArray();

        $labels = [];
        $data = [];
        $colors = [
            '#10b981', // success
            '#f59e0b', // warning
            '#3b82f6', // info
            '#ef4444', // danger
            '#8b5cf6', // purple
        ];

        $i = 0;
        foreach ($forestTypes as $type => $count) {
            $labels[] = match ($type) {
                'konservasi' => 'Konservasi',
                'produksi' => 'Produksi',
                'lindung' => 'Lindung',
                'wisata' => 'Wisata',
                default => ucfirst($type),
            };
            $data[] = $count;
            $i++;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Hutan',
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
