<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'category',
        'description',
        'display_order',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'display_order' => 'integer'
    ];

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
