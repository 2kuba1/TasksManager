<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected $fillable = ['id', 'name', 'email', 'password', 'user_id'];


    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
