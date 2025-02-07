<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

//ruta para mostrar el formulario de inicio de sesion 
//Route::get('/admin/login',[LoginController::class, 'showLoginForm'])->name('admin.login');

//ruta para manejar el inicio de sesion 
//Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');

//Route::get('/dashboard', function () {
//	return view('dashboard');
//})->middleware('auth');
