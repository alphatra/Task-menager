<?php

$routes = [];

switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/createList' :
        require __DIR__ . '/views/createList.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
route('/', function () {
    require __DIR__ . '/views/index.php';
    break;
});

route('', function () {
    require __DIR__ . '/views/index.php';
    break;
});

route('/createList', function () {
    require __DIR__ . '/views/createList.php';
    break;
});
  
route('/404', function () {
    echo "Page not found";
    break;
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