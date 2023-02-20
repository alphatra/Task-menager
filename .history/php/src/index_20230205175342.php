<?php
$routes = [
    '/' => './viwes/index.php',
    '/about' => 'about.php',
    '/contact' => 'contact.php'
];

$uri = $_SERVER['REQUEST_URI'];

if (array_key_exists($uri, $routes)) {
    include $routes[$uri];
} else {
    http_response_code(404);
    include '404.php';
}
?>