<?php

namespace App\Http\Controller;

abstract class BaseController
{
    public function __construct() {

    }

    // Выполняется перед вызовом метода-обработчика
    public function boot(): void
    {

    }

    // Выполняется после вызова метода-обработчика
    public function shutdown(): void
    {

    }

    public function test()
    {
        header('Access-Control-Allow-Origin: *');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('HTTP/1.1 200 OK');

        echo json_encode(["message" => "it's work"]);
    }
}