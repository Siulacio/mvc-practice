<?php

use FastRoute\RouteCollector;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$container = require __DIR__ . '/app/bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(
    function (RouteCollector $router)
    {
        $router->addRoute('GET', '/', ['Application\Controllers\HomeController', 'index']);
        $router->addRoute('GET', '/insert', ['Application\Controllers\HomeController', 'insert']);
        $router->addRoute('GET', '/all', ['Application\Controllers\HomeController', 'all']);
        $router->addRoute('GET', '/find/{id}', ['Application\Controllers\HomeController', 'findOne']);
        $router->addRoute('GET', '/update/{id}', ['Application\Controllers\HomeController', 'update']);
        $router->addRoute('GET', '/remove/{id}', ['Application\Controllers\HomeController', 'remove']);
        $router->addRoute('GET', '/find-by-username/{username}', ['Application\Controllers\HomeController', 'findByUsername']);
        $router->addRoute('GET', '/insert-post/{user_id}', ['Application\Controllers\HomeController', 'insertPost']);
        $router->addRoute('GET', '/find-user-with-posts/{user_id}', ['Application\Controllers\HomeController', 'findUserWithPosts']);

        $router->addRoute(['GET', 'POST'], '/login', ['Application\Controllers\AuthController', 'login']);
        $router->addRoute(['GET', 'POST'], '/registro', ['Application\Controllers\AuthController', 'registro']);

//        $router->addRoute('GET', '/', ['Blog\Controllers\HomeController', 'index']);
//        $router->addRoute('GET', '/articulos', ['Blog\Controllers\HomeController', 'articulos']);
//        $router->addRoute('GET', '/articulo/{id}', ['Blog\Controllers\HomeController', 'articulo']);
    }
);

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0])
{
    case \FastRoute\Dispatcher::NOT_FOUND:
        echo '404 NOT FOUND';
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '404 NOT ALLOWED';
        break;
    case \FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];
        $container->call($controller, $parameters);
        break;
}

