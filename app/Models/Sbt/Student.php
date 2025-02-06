<?php

namespace App\Models\Sbt;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'sbt';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($gender) => $gender ? 'l' : 'p',
        );
    }

    protected function photo(): Attribute
    {
        $imagesPath = '/storage/images';
        return Attribute::make(
            get: fn($photo) => $photo ? url("{$imagesPath}/students/{$photo}") : null,
        );
    }

    // 

    function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class);
    }

    function plps(): BelongsToMany
    {
        return $this->belongsToMany(Plp::class);
    }

    function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
}
