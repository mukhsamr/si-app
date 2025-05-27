<?php

namespace App\Models\Sdt;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->created_at)->translatedFormat('l, d M y')
        );
    }

    protected function startHour(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->created_at)->format('H:i:s')
        );
    }

    protected function endHour(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->updated_at)->format('H:i:s')
        );
    }

    function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function scopeIsReturned($query, $value)
    {
        return $query->where('is_returned', $value);
    }

    function scopeWithOperator($query)
    {
        $query->addSelect([
            'operator' => User::select('username')->whereColumn('loans.user_id', 'users.id')->limit(1)
        ]);
    }
}
