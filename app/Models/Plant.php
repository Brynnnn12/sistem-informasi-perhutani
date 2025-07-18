<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plant extends Model
{
    use HasUuids;

    protected $fillable = [
        'forest_id',
        'name',
        'type',
        'quantity',
        'description',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'type' => 'string',
    ];

    // Relasi dengan Forest
    public function forest(): BelongsTo
    {
        return $this->belongsTo(Forest::class);
    }
}
