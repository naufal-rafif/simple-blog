<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article_tag = [
            [
                'article_id' => 1,
                'tag_id' => 1,
            ],
            [
                'article_id' => 1,
                'tag_id' => 2,
            ],
            [
                'article_id' => 2,
                'tag_id' => 1,
            ],
            [
                'article_id' => 2,
                'tag_id' => 3,
            ],
            [
                'article_id' => 3,
                'tag_id' => 1,
            ],
            [
                'article_id' => 4,
                'tag_id' => 2,
            ],
            [
                'article_id' => 5,
                'tag_id' => 2,
            ],
            [
                'article_id' => 5,
                'tag_id' => 3,
            ],
            [
                'article_id' => 6,
                'tag_id' => 2,
            ],
            [
                'article_id' => 6,
                'tag_id' => 3,
            ],
        ];

        foreach ($article_tag as $key => $value) {
            DB::table('article_tag')->insert($value);
        }
    }
}
