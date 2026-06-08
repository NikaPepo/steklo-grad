<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CopiesSeedImages;

class ServiceSeeder extends Seeder
{
    use CopiesSeedImages;
    /**
     * Run the database seeds.
     */
    private array $services = [
        [
            'name' => 'Установка пластиковых окон',
            'thumbnail_url' => 'vuezd-zamershika-1.png',
            'image_url' => 'vuezd-zamershika-2.jpg',
            'description' => 'Описание услуги...',
            'meta_title' => 'Установка пластиковых окон',
            'meta_description' => 'Профессиональная установка окон',
        ],
    ];
    private function createServices(array $services)
    {
        foreach ($services as $service) {
            $imageUrl = null;
            $thumbnailUrl = null;
            if (!empty($service['thumbnail_url'])) {
                $thumbnailUrl = $this->copySeedImage($service['thumbnail_url'], 'services/thumbnails');
            }
            if (!empty($service['image_url'])) {
                $imageUrl = $this->copySeedImage($service['image_url'], 'services/images');
            }
            Service::create([
               'name' => $service['name'],
               'thumbnail_url' => $thumbnailUrl,
               'image_url' => $imageUrl,
               'description' => $service['description'],
               'meta_title' => $service['meta_title'],
               'meta_description' => $service['meta_description'],
            ]);

        }
    }

    public function run(): void
    {
        $this->createServices($this->services);
    }
}
