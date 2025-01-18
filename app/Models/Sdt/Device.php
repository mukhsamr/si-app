<?php

namespace App\Models\Sdt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    protected $connection = 'sdt';
    public $timestamps = false;
    protected $guarded = ['id'];

    function rak(): BelongsTo
    {
        return $this->belongsTo(Rak::class);
    }

    function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
