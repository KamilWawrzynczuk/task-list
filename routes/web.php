<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Main Page';
});

// set up name for route
Route::get("/xxx", function () {
    return 'Hello';
})->name('hello route');

Route::get('hallo', function () {
    return redirect()->route('hello route');
});

Route::get('/greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
});

// If route is not a match
Route::fallback(function () {
    return 'Still ot somwhere!';
});


// GET
// POST
// PUT
// DELETE
