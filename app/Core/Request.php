<?php
namespace App\Core;
use App\Core\Uri;
class Request {
    private $method;
    private $uri;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = new Uri($_SERVER['REQUEST_URI']);
    }

    public function getMethod() {
        return $this->method;
    }

    public function getUri() {
        return $this->uri->getPath();
    }

    public function getParams() {
        return $_GET;
    }

    public function getPostData() {
        return $_POST;
    }
}
