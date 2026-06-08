<?php

namespace Database\Seeders;

use App\Enums\OptionEnum;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private array $options = [
        [
            'name' => OptionEnum::Post->value,
            'value' => 'info@example.com',
        ],
        [
            'name' => OptionEnum::Phone->value,
            'value' => '+7 (999) 111-11-11',
        ],
        [
            'name' => OptionEnum::Phone2->value,
            'value' => '+7 (999) 222-22-22',
        ],
    ];

    private function createOptions(array $options): void
    {
        foreach ($options as $option) {
            Option::create([
                'name' => $option['name'],
                'value' => $option['value']
            ]);
        }
    }

    public function run(): void
    {
        $this->createOptions($this->options);
    }
}
