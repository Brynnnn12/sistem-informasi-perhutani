<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Submission extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'attachment',
        'status',
        'submitted_at',
        'approved_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'status' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($submission) {
            if (!$submission->user_id) {
                $submission->user_id = Auth::id();
            }
            if (!$submission->status) {
                $submission->status = 'pending';
            }
            if (!$submission->submitted_at) {
                $submission->submitted_at = now();
            }
        });
    }

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
