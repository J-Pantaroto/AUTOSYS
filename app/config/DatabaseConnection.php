<?php
namespace App\Config;

class DatabaseConnection {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            self::connect();
        }
        return self::$connection;
    }

    private static function connect() {
        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];
        $port = $_ENV['DB_PORT'] ?? 3306;

        self::$connection = new \mysqli($host, $username, $password, $database, $port);

        if (self::$connection->connect_error) {
            die("Erro na conexão com o banco de dados: " . self::$connection->connect_error);
        }
    }

    public static function query($sql) {
        $connection = self::getConnection();
        $result = $connection->query($sql);

        if ($connection->error) {
            die("Erro na consulta: " . $connection->error);
        }

        return $result;
    }

    public static function escape($value) {
        $connection = self::getConnection();
        return $connection->real_escape_string($value);
    }

    public static function closeConnection() {
        if (self::$connection !== null) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}
