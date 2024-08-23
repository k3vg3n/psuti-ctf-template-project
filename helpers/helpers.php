<?php

function env($key, $default = null) {
    $value = getenv($key);

    if (empty($value)) {
        return secret($key, $default);
    }

    return $value;
}

function secret($key, $default = null)
{
    return \Core\Secret::get($key) ?? $default;
}