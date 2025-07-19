<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi dengan Submissions
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    // Relasi dengan Reports
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    // Relasi dengan Articles (sebagai penulis)
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'created_by');
    }

    // Method untuk mengirim reset password notification kustom
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // Method untuk mendapatkan URL avatar
    public function getAvatarUrl(): string
    {
        // Jika menggunakan DiceBear API v9.x dengan style croodles
        $seed = $this->avatar ?? 'anime-1';
        return "https://api.dicebear.com/9.x/croodles/svg?seed={$seed}";
    }

    // Method untuk mendapatkan daftar avatar yang tersedia
    public static function getAvailableAvatars(): array
    {
        return [
            'anime-1' => 'Adventurer Hero',
            'anime-2' => 'Magical Girl',
            'anime-3' => 'Smart Scholar',
            'anime-4' => 'Mystic Warrior',
            'anime-5' => 'Cat Lover',
            'anime-6' => 'Dark Knight',
            'anime-7' => 'Princess',
            'anime-8' => 'Ninja Master',
            'anime-9' => 'Forest Guardian',
            'anime-10' => 'Fire Mage',
            'anime-11' => 'Ice Queen',
            'anime-12' => 'Thunder God',
        ];
    }
}
