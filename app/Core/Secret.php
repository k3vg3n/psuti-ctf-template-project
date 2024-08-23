<?php

namespace Core;

class Secret
{
    private static array $secrets = [];

    public static function push(string $key, $value): void
    {
        self::$secrets[$key] = $value;
    }

    public static function get(string $key)
    {
        return self::$secrets[$key] ?? null;
    }
}