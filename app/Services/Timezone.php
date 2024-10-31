<?php

namespace App\Services;

final class Timezone
{
    private static string $timezone = 'Europe/Istanbul';

    public static function get()
    {
        return self::$timezone;

    }

    public static function set($timezone = 'Europe/Istanbul'): void
    {
        self::$timezone = $timezone;
    }

}
