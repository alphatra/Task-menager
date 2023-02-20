<?php

$routes = [];

route('/', function () {
    require __DIR__ . '/views/index.php';
});

route('', function () {
    require __DIR__ . '/views/index.php';
});

route('/createList', function () {
    require __DIR__ . '/views/createList.php';
});
  
route('/404', function () {
    require __DIR__ . '/views/404.php';
});
  
  function route(string $path, callable $callback) {
    global $routes;
    $routes[$path] = $callback;
  }

run();

function run() {
    global $routes;
    $uri = $_SERVER['REQUEST_URI'];
    $found = false;
    foreach ($routes as $path => $callback) {
      if ($path !== $uri) continue;
  
      $found = true;
      $callback();
    }
  
    if (!$found) {
      $notFoundCallback = $routes['/404'];
      $notFoundCallback();
    }
}
?>