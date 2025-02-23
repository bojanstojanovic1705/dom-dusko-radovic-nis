<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'main_image',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Automatsko generisanje slug-a iz naslova
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            if (!$news->slug) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    // Relacija sa slikama vesti
    public function images()
    {
        return $this->hasMany(NewsImage::class)->orderBy('sort_order');
    }

    // Scope za objavljene vesti
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now())
                    ->latest('published_at');
    }
}
