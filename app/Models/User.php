<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'name',
        'email',
        'password',
        'role',
        'status',
        'avatar',
        'last_login_at',
        'last_login_ip',
        'login_attempts',
        'locked_until'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'locked_until' => 'datetime',
        'login_attempts' => 'integer'
    ];
     public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
     public function isActive(): bool
    {
        return $this->status === 'active';
    }
      public function isLocked(): bool
    {
        return $this->locked_until && now()->lt($this->locked_until);
    }
    public function resetLoginAttempts(): void
    {
        $this->update([
            'login_attempts' => 0,
            'locked_until' => null
        ]);
    }
      public function incrementLoginAttempts(): void
    {
        $this->increment('login_attempts');
    }
}
