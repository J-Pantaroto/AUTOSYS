<?php
namespace App\Helpers;
class Request{
    public static function get():string{
        return $_SERVER['REQUEST_METHOD'];
    }
}