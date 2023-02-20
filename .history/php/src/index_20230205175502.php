<?php
$routes = [
    '/' => 'views/index.php',
    '/about' => 'views/createList.php',
];

$uri = $_SERVER['REQUEST_URI'];

if (array_key_exists($uri, $routes)) {
    include $routes[$uri];
} else {
    http_response_code(404);
    include 'views/404.php';
}
?>