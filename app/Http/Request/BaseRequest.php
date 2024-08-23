<?php

namespace App\Http\Request;

class BaseRequest
{
    public string $method;
    public string $uri;
    public array $data;
    public array $headers;
    public array $files;

    public static function createFromGlobals(): static
    {
        $request = new static();
        $request->method = $_SERVER['REQUEST_METHOD'];
        $request->uri = $_SERVER['REQUEST_URI'];
        $request->data = self::getDataFromGlobals();
        $request->files = $_FILES;
        $request->headers = self::getHeadersFromGlobals();

        return $request;
    }

    private static function getDataFromGlobals(): array
    {
        if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/json') {
            return json_decode(file_get_contents('php://input'), true);
        }

        return match ($_SERVER['REQUEST_METHOD']) {
            'POST', 'PUT', 'PATCH', 'DELETE' => $_POST,
            default => $_GET,
        };
    }

    private static function getHeadersFromGlobals(): array
    {
        $headers = apache_request_headers();

        if ($headers !== false && count($headers)) {
            return $headers;
        }

        $headers = [];

        foreach ($_SERVER as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $headers[$key] = $value;
            }
        }

        return $headers;
    }
}