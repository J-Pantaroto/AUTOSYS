<?php
namespace App\Helpers;
class Uri
{
    public static function get($type): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])[$type];
        return rtrim($uri, '/');
    }    
}
