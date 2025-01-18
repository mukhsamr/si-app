<?php

namespace App\Models\Sdt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rak extends Model
{
    use HasFactory;

    protected $connection = 'sdt';
    public $timestamps = false;
    protected $guarded = ['id'];

    function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }
}
