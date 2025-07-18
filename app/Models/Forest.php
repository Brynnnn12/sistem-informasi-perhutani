<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forest extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'location',
        'area_size',
        'description',
        'status',
        'forest_type',
    ];

    protected $casts = [
        'area_size' => 'float',
        'status' => 'string',
        'forest_type' => 'string',
    ];

    // Relasi dengan Plants
    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class);
    }

    // Relasi dengan Reports
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
