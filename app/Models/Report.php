<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($report) {
            if (!$report->user_id) {
                $report->user_id = Auth::id();
            }
            if (!$report->status) {
                $report->status = 'pending';
            }
            if (!$report->reported_at) {
                $report->reported_at = now();
            }
        });
    }

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
