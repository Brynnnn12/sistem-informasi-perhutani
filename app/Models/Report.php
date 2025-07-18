<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'forest_id',
        'title',
        'description',
        'photo',
        'status',
        'reported_at',
        'verified_at',
    ];

    protected $casts = [
        'reported_at' => 'datetime',
        'verified_at' => 'datetime',
        'status' => 'string',
    ];

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Forest
    public function forest(): BelongsTo
    {
        return $this->belongsTo(Forest::class);
    }
}
