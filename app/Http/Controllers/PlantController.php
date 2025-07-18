<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        // Sample plant data for demonstration
        $plants = [
            [
                'id' => 1,
                'name' => 'Jati (Tectona grandis)',
                'scientific_name' => 'Tectona grandis',
                'family' => 'Lamiaceae',
                'habitat' => 'Hutan tropis dan subtropis',
                'conservation_status' => 'Tidak Terancam',
                'description' => 'Pohon jati adalah salah satu jenis kayu keras yang memiliki nilai ekonomi tinggi. Kayu jati sangat tahan terhadap cuaca dan serangga, sehingga banyak digunakan untuk furniture dan konstruksi.',
                'image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400&h=300&fit=crop',
                'uses' => ['Furniture', 'Konstruksi', 'Kerajinan'],
                'location' => 'Jawa, Sumatra, Kalimantan'
            ],
            [
                'id' => 2,
                'name' => 'Mahoni (Swietenia mahagoni)',
                'scientific_name' => 'Swietenia mahagoni',
                'family' => 'Meliaceae',
                'habitat' => 'Hutan hujan tropis',
                'conservation_status' => 'Rentan',
                'description' => 'Mahoni adalah pohon besar yang menghasilkan kayu berkualitas tinggi dengan warna kemerahan yang khas. Pohon ini juga dikenal karena kemampuannya menyerap karbon dioksida dalam jumlah besar.',
                'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&h=300&fit=crop',
                'uses' => ['Furniture mewah', 'Instrumen musik', 'Ukiran'],
                'location' => 'Jawa, Sumatra, Bali'
            ],
            [
                'id' => 3,
                'name' => 'Meranti (Shorea spp.)',
                'scientific_name' => 'Shorea spp.',
                'family' => 'Dipterocarpaceae',
                'habitat' => 'Hutan hujan dataran rendah',
                'conservation_status' => 'Terancam',
                'description' => 'Meranti adalah genus pohon yang mencakup berbagai spesies penghasil kayu komersial penting. Pohon-pohon ini adalah komponen utama hutan hujan Asia Tenggara.',
                'image' => 'https://images.unsplash.com/photo-1574263867128-ee18b6068c19?w=400&h=300&fit=crop',
                'uses' => ['Kayu lapis', 'Konstruksi ringan', 'Pulp'],
                'location' => 'Sumatra, Kalimantan, Papua'
            ],
            [
                'id' => 4,
                'name' => 'Eboni (Diospyros celebica)',
                'scientific_name' => 'Diospyros celebica',
                'family' => 'Ebenaceae',
                'habitat' => 'Hutan primer dataran rendah',
                'conservation_status' => 'Sangat Terancam',
                'description' => 'Eboni Sulawesi adalah kayu hitam yang sangat berharga dan langka. Pohon ini endemik Sulawesi dan menghadapi ancaman kepunahan akibat eksploitasi berlebihan.',
                'image' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?w=400&h=300&fit=crop',
                'uses' => ['Kerajinan mewah', 'Instrumen musik', 'Ukiran artistik'],
                'location' => 'Sulawesi'
            ],
            [
                'id' => 5,
                'name' => 'Sengon (Falcataria moluccana)',
                'scientific_name' => 'Falcataria moluccana',
                'family' => 'Fabaceae',
                'habitat' => 'Hutan sekunder dan lahan terbuka',
                'conservation_status' => 'Tidak Terancam',
                'description' => 'Sengon adalah pohon cepat tumbuh yang banyak ditanam untuk reboisasi dan agroforestri. Kayunya ringan dan cocok untuk berbagai keperluan konstruksi ringan.',
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop',
                'uses' => ['Kayu lapis', 'Furniture ringan', 'Bahan bangunan'],
                'location' => 'Jawa, Sumatra, Maluku'
            ],
            [
                'id' => 6,
                'name' => 'Ulin (Eusideroxylon zwageri)',
                'scientific_name' => 'Eusideroxylon zwageri',
                'family' => 'Lauraceae',
                'habitat' => 'Hutan hujan dataran rendah',
                'conservation_status' => 'Rentan',
                'description' => 'Ulin atau kayu besi adalah pohon yang menghasilkan kayu sangat keras dan tahan lama. Pohon ini tumbuh sangat lambat dan menjadi simbol ketahanan hutan Kalimantan.',
                'image' => 'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?w=400&h=300&fit=crop',
                'uses' => ['Konstruksi berat', 'Jembatan', 'Tiang pancang'],
                'location' => 'Kalimantan'
            ]
        ];

        return view('plants.index', compact('plants'));
    }

    public function show($id)
    {
        // This would typically fetch from database
        $plants = $this->getSamplePlants();
        $plant = collect($plants)->firstWhere('id', (int)$id);

        if (!$plant) {
            abort(404);
        }

        return view('plants.show', compact('plant'));
    }

    private function getSamplePlants()
    {
        // Same data as above, in a real app this would be from database
        return [
            [
                'id' => 1,
                'name' => 'Jati (Tectona grandis)',
                'scientific_name' => 'Tectona grandis',
                'family' => 'Lamiaceae',
                'habitat' => 'Hutan tropis dan subtropis',
                'conservation_status' => 'Tidak Terancam',
                'description' => 'Pohon jati adalah salah satu jenis kayu keras yang memiliki nilai ekonomi tinggi. Kayu jati sangat tahan terhadap cuaca dan serangga, sehingga banyak digunakan untuk furniture dan konstruksi.',
                'image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400&h=300&fit=crop',
                'uses' => ['Furniture', 'Konstruksi', 'Kerajinan'],
                'location' => 'Jawa, Sumatra, Kalimantan'
            ],
            // ... other plants
        ];
    }
}
