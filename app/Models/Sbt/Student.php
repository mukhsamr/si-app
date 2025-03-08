<?php

namespace App\Models\Sbt;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($gender) => $gender ? 'l' : 'p',
        );
    }

    protected function photo(): Attribute
    {
        $imagesPath = '/storage/students/avatar';
        return Attribute::make(
            get: fn($photo) => $photo ? url("{$imagesPath}/{$photo}") : null,
        );
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => Carbon::parse($attributes['birth_date'])->age
        );
    }

    // 
    function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    function latestNote(): Hasone
    {
        return $this->hasOne(Note::class)->latestOfMany();
    }
}
