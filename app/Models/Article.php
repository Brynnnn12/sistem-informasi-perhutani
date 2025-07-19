<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'cover_image',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Auto generate slug dari title dan set published_at
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }

            // Otomatis set published_at ke sekarang jika belum diset
            if (empty($article->published_at)) {
                $article->published_at = now();
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    // Relasi dengan User (penulis)
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Accessor untuk cover image URL
    public function getCoverImageUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            return Storage::disk('public')->url($this->cover_image);
        }
        return null;
    }
}
