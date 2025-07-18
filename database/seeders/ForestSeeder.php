<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Forest;
use App\Models\Plant;

class ForestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data sample hutan
        $forests = [
            [
                'name' => 'Hutan Gunung Slamet',
                'location' => 'Koordinat GPS: -7.2429, 109.2083',
                'area_size' => 2500.50,
                'description' => 'Hutan konservasi di lereng Gunung Slamet dengan keanekaragaman hayati tinggi.',
                'status' => 'protected',
            ],
            [
                'name' => 'Hutan Produksi Jati Magelang',
                'location' => 'Jalan Raya Magelang KM 15, Jawa Tengah',
                'area_size' => 1800.75,
                'description' => 'Hutan produksi jati untuk kebutuhan industri furniture.',
                'status' => 'active',
            ],
            [
                'name' => 'Hutan Lindung Merapi',
                'location' => 'Koordinat GPS: -7.5407, 110.4417',
                'area_size' => 3200.00,
                'description' => 'Hutan lindung di sekitar Gunung Merapi untuk mencegah bencana alam.',
                'status' => 'protected',
            ],
            [
                'name' => 'Hutan Rusak Kendal',
                'location' => 'Desa Wonosari, Kendal, Jawa Tengah',
                'area_size' => 450.25,
                'description' => 'Area hutan yang mengalami kerusakan akibat illegal logging.',
                'status' => 'damaged',
            ],
        ];

        foreach ($forests as $forestData) {
            $forest = Forest::create($forestData);

            // Tambahkan sample tanaman untuk setiap hutan
            $this->createSamplePlants($forest);
        }
    }

    private function createSamplePlants($forest)
    {
        $plantsByForest = [
            'Hutan Gunung Slamet' => [
                ['name' => 'Jati', 'type' => 'kayu_keras', 'quantity' => 500],
                ['name' => 'Mahoni', 'type' => 'kayu_keras', 'quantity' => 300],
                ['name' => 'Edelweis Jawa', 'type' => 'tanaman_endemik', 'quantity' => 150],
            ],
            'Hutan Produksi Jati Magelang' => [
                ['name' => 'Jati Emas', 'type' => 'kayu_keras', 'quantity' => 800],
                ['name' => 'Sengon', 'type' => 'kayu_lunak', 'quantity' => 400],
            ],
            'Hutan Lindung Merapi' => [
                ['name' => 'Cemara Gunung', 'type' => 'kayu_lunak', 'quantity' => 600],
                ['name' => 'Puspa Langka', 'type' => 'tanaman_endemik', 'quantity' => 80],
                ['name' => 'Akasia', 'type' => 'kayu_keras', 'quantity' => 350],
            ],
            'Hutan Rusak Kendal' => [
                ['name' => 'Sisa Jati', 'type' => 'kayu_keras', 'quantity' => 50],
                ['name' => 'Bambu', 'type' => 'kayu_lunak', 'quantity' => 120],
            ],
        ];

        $plants = $plantsByForest[$forest->name] ?? [];

        foreach ($plants as $plantData) {
            Plant::create([
                'forest_id' => $forest->id,
                'name' => $plantData['name'],
                'type' => $plantData['type'],
                'quantity' => $plantData['quantity'],
                'description' => "Tanaman {$plantData['name']} di {$forest->name}",
            ]);
        }
    }
}
