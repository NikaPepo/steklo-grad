<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\DefaultCategoryEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Database\Seeders\Traits\CopiesSeedImages;

class CatalogSeeder extends Seeder
{
    use CopiesSeedImages;
    private function tree(): array
    {
        return [
            [
                'name' => DefaultCategoryEnum::Windows->value,
                ...$this->windowsMeta(),
                'children' => [
                    [
                        'name' => 'Окна и двери ПВХ REHAU',
                        'thumbnail_url' => 'okna-i-dveri-pvh-rehau.jpg',
                        ...$this->windowsMeta(),
                        'products' => [
                            [
                                'name' => 'REHAU INTELIO80',
                                'image_url' => 'rehau-intelio80.jpg',
                                'description' => 'Окно',
                                ...$this->windowsMeta()
                            ],
                            [
                                'name' => 'REHAU GENEO',
                                'image_url' => 'rehau-geneo.jpg',
                                'description' => 'Окно',
                                ...$this->windowsMeta()
                            ]
                        ]
                    ],
                    [
                        'name' => 'Остекление балкона и лоджий',
                        'thumbnail_url' => 'osteklenie-balkona-i-lodzhij.jpg',
                        ...$this->windowsMeta(),
                        'products' => [
                            [
                                'name' => 'Alutech C48',
                                'image_url' => 'alutech-c48.jpg',
                                'description' => 'Окно',
                                ...$this->windowsMeta()
                            ],
                            [
                                'name' => 'Blitz New',
                                'image_url' => 'blitz-new.jpg',
                                'description' => 'Окно',
                                ...$this->windowsMeta()
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => DefaultCategoryEnum::Glazing->value,
                ...$this->glazingMeta(),
                'children' => [
                    [
                        'name' => 'Стеклянные перегородки',
                        'thumbnail_url' => 'steklyannye-peregorodki.jpg',
                        ...$this->glazingMeta(),
                        'children' => [
                            [
                                'name' => 'На Заказ',
                                'thumbnail_url' => 'na-zakaz-steklyannye-peregorodki.jpg',
                                ...$this->glazingMeta(),
                                'products' => [
                                    [
                                        'name' => 'Стеклянная перегородка 1',
                                        'image_url' => 'steklyannaya-peregorodka-1.jpg',
                                        'description' => 'Стеклянная перегородка',
                                        ...$this->glazingMeta()
                                    ],
                                    [
                                        'name' => 'Стеклянная перегородка 2',
                                        'image_url' => 'steklyannaya-peregorodka-2.jpg',
                                        'description' => 'Стеклянная перегородка',
                                        ...$this->glazingMeta()
                                    ]
                                ]

                            ]
                        ]
                    ],
                    [
                        'name' => 'Душевые кабины',
                        'thumbnail_url' => 'dushevye-kabiny.jpg',
                        ...$this->glazingMeta(),
                        'children' => [
                            [
                                'name' => 'На Заказ',
                                'thumbnail_url' => 'na-zakaz-dushevye-kabiny.jpg',
                                ...$this->glazingMeta(),
                                'products' => [
                                    [
                                        'name' => 'Душевая кабина 1',
                                        'image_url' => 'dushevaya-kabina-1.jpg',
                                        'description' => 'Душевая кабина',
                                        ...$this->glazingMeta()
                                    ],
                                    [
                                        'name' => 'Душевая кабина 2',
                                        'image_url' => 'dushevaya-kabina-2.jpg',
                                        'description' => 'Душевая кабина',
                                        ...$this->glazingMeta()
                                    ],
                                    [
                                        'name' => 'Душевая кабина 3',
                                        'image_url' => 'dushevaya-kabina-3.jpg',
                                        'description' => 'Душевая кабина',
                                        ...$this->glazingMeta()
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Готовые',
                                'thumbnail_url' => 'gotovye-dushevye-kabiny.jpg',
                                ...$this->glazingMeta(),
                                'products' => [
                                    [
                                        'name' => 'Душевая кабина RGW-2819',
                                        'image_url' => 'dushevaya-kabina-rgw-2819.jpg',
                                        'description' => 'Душевая кабина',
                                        ...$this->glazingMeta()
                                    ],
                                    [
                                        'name' => 'Душевая кабина AN-208',
                                        'image_url' => 'dushevaya-kabina-an-208.jpg',
                                        'description' => 'Душевая кабина',
                                        ...$this->glazingMeta()
                                    ],
                                    [
                                        'name' => 'Душевая кабина RGW AN-207',
                                        'image_url' => 'dushevaya-kabina-rgw-an-207.jpg',
                                        'description' => 'Душевая кабина',
                                        ...$this->glazingMeta()
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]

        ];
    }

    private
    function glazingMeta(): array
    {
        return [
            'meta_title' => DefaultCategoryEnum::Glazing->value,
            'meta_description' => 'Лучшее стекло во вселенной!',
        ];
    }

    private
    function windowsMeta(): array
    {
        return [
            'meta_title' => DefaultCategoryEnum::Windows->value,
            'meta_description' => 'Лучшие окна во вселенной!',
        ];
    }

    private function createTree(array $nodes, ?int $parentId = null): void
    {
        foreach ($nodes as $node) {
            $thumbnail = null;
            if (!empty($node['thumbnail_url'])) {
                $thumbnail = $this->copySeedImage($node['thumbnail_url'], 'categories');
            }
            $category = Category::create([
                'name' => $node['name'],
                'thumbnail_url' => $thumbnail,
                'meta_title' => $node['meta_title'] ?? null,
                'meta_description' => $node['meta_description'] ?? null,
                'parent_id' => $parentId
            ]);

            if (!empty($node['children'])) {
                $this->createTree($node['children'], $category->id);
            }
            if (!empty($node['products'])) {
                $this->createProducts($node['products'], $category->id);
            }
        }
    }

    private
    function createProducts(array $products, int $categoryId): void
    {
        foreach ($products as $product) {
            $image = null;
            if (!empty($product['image_url'])) {
                $image = $this->copySeedImage($product['image_url'], 'products');
            }
            Product::create([
                'category_id' => $categoryId,
                'name' => $product['name'],
                'image_url' => $image,
                'description' => $product['description'] ?? fake()->paragraph(),
                'meta_title' => $product['meta_title'] ?? null,
                'meta_description' => $product['meta_description'] ?? null,
            ]);

        }
    }





    public
    function run(): void
    {
        $this->createTree($this->tree());
    }
}