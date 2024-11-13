    <?php
    class EnvLoader {
        public static function load($path) {
            if (file_exists($path)) {
                $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    [$key, $value] = explode("=", $line, 2);
                    $_ENV[trim($key)] = trim($value);
                }
            }
        }
    }

    EnvLoader::load(__DIR__ . '/../.env');
