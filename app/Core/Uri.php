<?php
namespace App\Core;

class Uri {
    private $path;

    public function __construct($uri) {
        $this->path = parse_url($uri, PHP_URL_PATH);
    }

    public function getPath() {
        return $this->path;
    }

    public function getSegments() {
        return explode('/', trim($this->path, '/'));
    }
}
