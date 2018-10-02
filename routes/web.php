<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Registro das Rotas do Sistema
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/construcao', function () {
    return view('construcao');
});
