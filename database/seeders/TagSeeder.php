<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name' => 'Murah',
                'color' => '#895AB8',
                'background' => '#EDD0FF'
            ],
            [
                'name' => 'Iphone',
                'color' => '#E89900',
                'background' => '#FFFACF'
            ],
            [
                'name' => 'Seni',
                'color' => '#E89900',
                'background' => '#FFFACF'
            ]
        ];
        foreach ($tags as $key => $value) {
            Tag::create($value);
        }
    }
}
