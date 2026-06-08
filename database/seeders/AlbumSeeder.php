<?php

namespace Database\Seeders;

use App\Enums\AlbumEnum;
use App\Enums\DefaultAboutEnum;
use App\Models\Album;
use App\Models\AlbumImage;
use http\Encoding\Stream\Inflate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Database\Seeders\Traits\CopiesSeedImages;

class AlbumSeeder extends Seeder
{
    use CopiesSeedImages;
    /**
     * Run the database seeds.
     */
    private array $tree = [
        [
            'name' => 'Главная страница',
            'slug' => AlbumEnum::WelcomeAlbum->value,
            'is_visible' => false,
            'album_images' => [
                [
                    'url' => 'glavnaia-stranica-2.jpg',
                    'title' => 'Стеклоизделия любой сложности',
                    'subtitle' => 'Выполняем индивидуальные заказы и предлагаем готовые решения в г. Москве и области',
                ],
                [
                    'url' => 'glavnaia-stranica-1.jpg',
                    'title' => 'Высокое качество изделий',
                    'subtitle' => 'Эксклюзивные варианты для реализации ваших «стеклянных» желаний',
                ],
                [
                    'url' => 'glavnaia-stranica-3.jpg',
                    'title' => 'Мы сделаем Ваш мир радужней!',
                    'subtitle' => '',
                ]
            ],
        ],
        [
            'name' => 'Главная баннер',
            'slug' => AlbumEnum::BannerAlbum->value,
            'is_visible' => false,
            'album_images' => [
                [
                    'url' => 'glavnaia-banner-1.jpg',
                    'title' => 'Бесплатный выезд замерщика!',
                    'subtitle' => '',
                ],
                [
                    'url' => 'glavnaia-banner-1.jpg',
                    'title' => 'Каждое пятое окно в подарок',
                    'subtitle' => '',
                ]
            ]
        ],
        [
            'name' => 'Главная галерея',
            'slug' => AlbumEnum::GalleryPreviewAlbum->value,
            'is_visible' => false,
            'album_images' => [
                [
                    'url' => 'glanaya-galereya-1.jpg'
                ],
                [
                    'url' => 'glanaya-galereya-2.JPEG'
                ],
                [
                    'url' => 'glanaya-galereya-3.jpg'
                ]
            ]
        ],
        [
            'name' => 'Услуга',
            'slug' => AlbumEnum::ServiceAlbum->value,
            'is_visible' => false,
            'album_images' => [
                [
                    'url' => 'service-1.jpg',
                ]
            ]
        ],
        [
            'name' => 'О компании',
            'slug' => DefaultAboutEnum::About->value,
            'is_visible' => false,
            'album_images' => [
                [
                    'url' => 'o-kompanii-1.jpg',
                ],
                [
                    'url' => 'o-kompanii-2.jpg',
                ],
                [
                    'url' => 'o-kompanii-3.jpg',
                ]
            ]
        ],
        [
            'name' => 'Душевые кабины',
            'thumbnail_url' => 'dushevye-kabiny.jpg',
            'album_images' => [
                [
                    'url' => 'dushevaya-kabina-1.jpg',
                ],
                [
                    'url' => 'dushevaya-kabina-2.jpg',
                ],
                [
                    'url' => 'dushevaya-kabina-3.jpg',
                ]
            ]
        ]

    ];

    private function createTree(array $nodes): void
    {
        foreach ($nodes as $node) {
            $thumbnailUrl = null;
            if (!empty($node['thumbnail_url'])) {
                $thumbnailUrl = $this->copySeedImage($node['thumbnail_url'], 'albums'); ;
            }
            $album = Album::create([
                'name' => $node['name'],
                'slug' => $node['slug'] ?? null,
                'thumbnail_url' => $thumbnailUrl ?? null,
                'is_visible' => $node['is_visible'] ?? true,
            ]);
            if (!empty($node['album_images'])) {
                $this->createAlbumImages($node['album_images'], $album->id);
            }
        }
    }

    private function createAlbumImages(array $images, int $albumId): void
    {
        foreach ($images as $image) {
            $url = null;
            if (!empty($image['url'])) {
                $url = $this->copySeedImage($image['url'], 'album_images'); ;
            }
            AlbumImage::create([
                'album_id' => $albumId,
                'url' => $url,
                'title' => $image['title'] ?? null,
                'subtitle' => $image['subtitle'] ?? null,
            ]);
        }
    }


    public function run(): void
    {
        $this->createTree($this->tree);
    }
}
