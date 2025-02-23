<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News; // Added the missing import statement

class NewsImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'image_path',
        'caption',
        'sort_order'
    ];

    // Relacija sa vešću
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
