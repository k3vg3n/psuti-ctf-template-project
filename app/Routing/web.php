<?php

use App\Http\Controller\BaseController;
use App\Routing\Route;

Route::get('/', [BaseController::class, 'test']);