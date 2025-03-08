<?php

namespace App\Enums;

enum Unit: string
{
    case Tahfidz    = 'TAHFIDZ';
    case IT         = 'IT';
    case Bahasa     = 'BAHASA';
    case Karakter   = 'KARAKTER';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
