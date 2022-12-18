<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'gadget'
            ],
            [
                'name' => 'olahraga'
            ],
            [
                'name' => 'seni'
            ],
        ];

        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}
