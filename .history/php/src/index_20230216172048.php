<?php
$routes = [
    '/' => 'views/index.html',
    'createList' => 'views/createList.html',
    '/createProduct' => 'views/createProduct.html'
];

$uri = $_SERVER['REQUEST_URI'];

if (array_key_exists($uri, $routes)) {
    include $routes[$uri];
} else {
    http_response_code(404);
    include 'views/404.php';
}
?>