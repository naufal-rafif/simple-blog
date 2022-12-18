<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleService
{
    public function storeImage($image)
    {
        if (!is_null($image)) {
            $imageName = date('YmdHis') . '.' . $image->extension();
            $image->move(public_path('src/img/article'), $imageName);
            return $imageName;
        } else {
            return 'default.png';
        }
    }

    public function updateImage($image, $oldImage)
    {
        if (!is_null($image)) {
            $imageName = date('YmdHis') . '.' . $image->extension();

            if (file_exists(public_path('src/img/article/' . $oldImage))) {
                if ($oldImage != 'article.jpg' || $oldImage != 'article2.jpg' || $oldImage != 'article3.jpg') {
                    File::delete(public_path('src/img/article/' . $oldImage));
                }
            }
            $image->move(public_path('src/img/article'), $imageName);
            return $imageName;
        } else {
            return $oldImage;
        }
    }

    public function destroyImage($imageName)
    {
        if ($imageName != 'article.jpg' || $imageName != 'article2.jpg' || $imageName != 'article3.jpg') {
            if (file_exists(public_path('src/img/article/' . $imageName))) {
                File::delete(public_path('src/img/article/' . $imageName));
            }
        }
    }

    public function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $sum = Article::where('slug', '=', $slug)->get();
        if (count($sum) > 0) {
            return $slug = $slug . '-' . Carbon::now()->format('d-m-Y');
        } else {
            return $slug = $slug;
        }
    }
}
