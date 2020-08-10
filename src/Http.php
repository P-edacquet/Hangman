<?php

namespace App;

class Http
{
    public static function redirect(string $uri, bool $permanent = false): void
    {
        header('Location: '.$uri, true, $permanent ? 301 : 302);
    }
}
