<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable = [
        'name',
        'background',
        'color',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
