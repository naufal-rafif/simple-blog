<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable = [
        'title',
        'slug',
        'writer',
        'category_id',
        'image',
        'content',
        'status',
        'delete',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function showDeletedArticle($status)
    {
        return $this->select('articles.*', 'categories.name as category')
            ->with('tags')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->where("delete", $status)
            ->orderBy("status", "asc")
            ->latest()
            ->paginate(5);
    }
}
