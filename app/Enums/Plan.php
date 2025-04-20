<?php

namespace App\Enums;

enum Plan: string
{
    case TM = 'timeline';
    case ST = 'stepline';
    case MA = 'mayor_agenda';
    case MR = 'minor_routine';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
