<?php

namespace App\Config;

class EnvLoader
{
    public static function load($path)
    {
        if (!file_exists($path)) {
            throw new \Exception("Arquivo .env não encontrado: {$path}");
        }
 
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 
        foreach ($lines as $line) {
            // ignora linhas comentadas e sem chave=valor
            if (strpos(trim($line), '#') === 0 || !strpos($line, '=')) {
                continue;
            }
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}
EnvLoader::load(__DIR__ . '/.env');
