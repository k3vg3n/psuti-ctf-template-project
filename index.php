<?php

require_once "vendor/autoload.php";

try {
    \App\Routing\Route::resolve(\App\Http\Request\BaseRequest::createFromGlobals());
} catch (Exception $e) {
    echo "Error: {$e->getMessage()} => {$e->getFile()}:{$e->getLine()}";
}