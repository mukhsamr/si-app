<?php

namespace App\Models;

use App\Models\Scopes\ActiveStudentScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

#[ScopedBy([ActiveStudentScope::class])]
class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'app';
    protected $appends = ['age'];

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
        $imagesPath = '/storage/students/photo';
        return Attribute::make(
            get: fn($photo) => $photo ? url("{$imagesPath}/{$photo}") : null,
        );
    }


    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d-m-Y') : null
        );
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => Carbon::parse($attributes['birth_date'])->age
        );
    }


    // 
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

    // 
    function scopeCurrentGrades()
    {
        return $this->grades()->where('semester_id', Semester::active()->first()->id);
    }

    function scopeCurrentPlps()
    {
        return $this->plps()->where('semester_id', Semester::active()->first()->id);
    }
}
