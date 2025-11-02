<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // User Levels
    public const LEVEL_USER = 0;
    public const LEVEL_ADMIN = 1;

    // User Status
    public const STATUS_INACTIVE = '0';
    public const STATUS_ACTIVE = '1';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'level',
        'blood_type',
        'status',
        'last_question',
        'resp_date',
        'register_date',
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
            'level' => 'integer',
            'last_question' => 'integer',
        ];
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->level === self::LEVEL_ADMIN;
    }

    /**
     * Check if user is active.
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Get the user's level name.
     */
    protected function levelName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->level === self::LEVEL_ADMIN ? 'Administrador' : 'Usuário',
        );
    }

    /**
     * Get the user's status name.
     */
    protected function statusName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === self::STATUS_ACTIVE ? 'Ativo' : 'Inativo',
        );
    }

    /**
     * Get all available user levels.
     *
     * @return array<int, string>
     */
    public static function getLevels(): array
    {
        return [
            self::LEVEL_USER => 'Usuário',
            self::LEVEL_ADMIN => 'Administrador',
        ];
    }

    /**
     * Get all available statuses.
     *
     * @return array<string, string>
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_INACTIVE => 'Inativo',
            self::STATUS_ACTIVE => 'Ativo',
        ];
    }
}
