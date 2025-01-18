<?php

namespace App\Models\Sdt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $connection = 'sdt';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'is_returned' => 'boolean',
    ];

    function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function scopeIsNotReturned($query)
    {
        return $query->where('is_returned', false);
    }
}
