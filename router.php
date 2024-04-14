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
        // Check if the request contains any POST data
        if ($_SERVER['CONTENT_LENGTH'] > 0) {
            // Retrieve and process the POST data
            $postData = file_get_contents('php://input');
            $parsedData = json_decode($postData, true);

            // Perform any necessary processing based on the POST data
            // For example, you might save the data to a database, perform validation, etc.
            // Here's a simple example of echoing back the received data
            echo 'Received POST data: ' . json_encode($parsedData);
        } else {
            // If no POST data is received, handle the request accordingly
            echo 'No POST data received';
        }
    }
}

?>
