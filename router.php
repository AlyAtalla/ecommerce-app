<?php

class Router {
    protected $routes = []; // stores routes

    /*
    * add routes to the $routes
    */
    public function addRoute(string $method, string $url, Closure $target) {
        $this->routes[$method][$url] = $target;
    }

    public function matchRoute() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Extract the path from the URL

        // Ensure the URL starts with a slash
        $url = '/' . trim($url, '/');

        if (isset($this->routes[$method][$url])) {
            // If a route handler is defined for the current method and URL, call it
            call_user_func($this->routes[$method][$url]);
        } elseif ($method === 'POST' && $url === '/') {
            // Handle POST requests to the root path ("/")
            $this->handlePostRequest();
        } else {
            throw new Exception('Route not found');
        }
    }

    // Handle POST requests to the root path ("/")
    protected function handlePostRequest() {
        // Your logic for handling POST requests to the root path ("/") goes here
        echo 'Handling POST request to the root path ("/")';
    }
}
