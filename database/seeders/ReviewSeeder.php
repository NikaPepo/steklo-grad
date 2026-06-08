<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private array $reviews = [
        [
            'author' => 'Иван Петров',
            'author_phone_number' => '+7 999 123-45-67',
            'text' => 'Отличная работа, всё сделали вовремя.',
            'published' => true,
        ],
        [
            'author' => 'Мария Иванова',
            'author_phone_number' => '+7 999 765-43-21',
            'text' => 'Очень довольны остеклением балкона.',
            'published' => true,
        ],
    ];
    private function createReview(array $reviews):void
    {
        foreach ($reviews as $review) {
            Review::create([
                'author' => $review['author'],
                'author_phone_number' => $review['author_phone_number'],
                'text' => $review['text'],
                'published' => $review['published'],
                'date' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function run(): void
    {
        $this->createReview($this->reviews);
    }
}
