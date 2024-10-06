<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Log::info('Application is running');
});
