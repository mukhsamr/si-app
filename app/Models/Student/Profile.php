<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $connection = 'student';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

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
        $imagesPath = '/storage/students/images';
        return Attribute::make(
            get: fn($photo) => $photo ? url("{$imagesPath}/{$photo}") : null,
        );
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
