<?php

namespace App\Routing;

use App\Http\Request\BaseRequest;

class Route
{
    public static array $routes = [];

    public static function handleRoute(string $method, string $uri, array|callable $handle): void
    {
        self::$routes[$uri][$method] = $handle;
    }

    public static function get(string $uri, array|callable $handle): void
    {
        self::handleRoute('GET', $uri, $handle);
    }

    public static function post(string $uri, array|callable $handle): void
    {
        self::handleRoute('POST', $uri, $handle);
    }

    public static function put(string $uri, array|callable $handle): void
    {
        self::handleRoute('PUT', $uri, $handle);
    }

    public static function delete(string $uri, array|callable $handle): void
    {
        self::handleRoute('DELETE', $uri, $handle);
    }

    public static function resolve(BaseRequest $request): void
    {
        $uri = $request->uri;
        $method = $request->method;

        if (
            !array_key_exists($uri, self::$routes)
            ||
            !array_key_exists($method, self::$routes[$uri])
            ||
            !is_callable(self::$routes[$uri][$method])
        ) {
            header('HTTP/1.0 404 Not Found');
            return;
        }

        if (is_callable(self::$routes[$uri][$method])) {
            call_user_func(self::$routes[$uri][$method], $request);
        } else {
            $controller = self::$routes[$uri][$method][0];
            $action = self::$routes[$uri][$method][1];

            if (!class_exists($controller)) {
                throw new \Exception("Class \"{$controller}\" does not exist");
            }

            $controller = new $controller();
            if (!method_exists($controller, $action)) {
                throw new \Exception("Method \"{$method}\" does not exist in \"{$controller}\"");
            }

            $controller->$action($request);
        }
    }
}