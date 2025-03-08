<?php

namespace App\Models\Sbt;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Note extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $connection = 'sbt';

    protected $appends = ['summary'];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d-m-Y H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn($type) => $type ? 'p' : 'n',
        );
    }

    protected function file(): Attribute
    {
        $notesPath = '/storage/notes';
        return Attribute::make(
            get: function ($file) use ($notesPath) {
                $src = $file ? url("{$notesPath}/{$file}") : null;
                $type = '';

                if ($file) {
                    $filePath = public_path("storage/notes/{$file}");

                    if (file_exists($filePath)) {
                        $mimeType = mime_content_type($filePath);

                        if (strpos($mimeType, 'image/') === 0) {
                            $type = 'image';
                        }
                        if (strpos($mimeType, 'video/') === 0) {
                            $type = 'video';
                        }
                    }
                }

                return [
                    'src'  => $src,
                    'type' => $type,
                ];
            }
        );
    }


    protected function summary(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => Str::limit($attributes['note'], 40, '...')
        );
    }

    function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // 
    function scopeWithAuthor(Builder $query)
    {
        return $query->addSelect([
            'author' => Profile::select('nickname')->whereColumn('notes.user_id', 'profiles.user_id')->limit(1)
        ]);
    }
}
