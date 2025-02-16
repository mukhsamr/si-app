<?php

namespace App\Models\Santri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $connection = 'santri';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // 
    function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    function latestPlan(): HasOne
    {
        return $this->hasOne(Plan::class)->latestOfMany();
    }
}
