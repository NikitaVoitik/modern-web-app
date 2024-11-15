<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    protected $casts = ['published_at' => 'datetime',];

    function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    function summary(): string
    {
        return substr($this->content, 0, 200);
    }
}
