<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\LogController;
/**
 * @OA\Post(
 *  http://localhost:8000/login ; sirve para iniciar el login
 * Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'),    'verified',])->group(function () {Route::get('/dashboard', function () {return Inertia::render('Dashboard');
 * })->name('dashboard');  ; tiene la ruta dashboard de inicio 
 *  Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); ; tiene la ruta en la que se muestren los posts;
   *  Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); ; ruta para crear los posts;
   *   Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); ; ruta que sirve para guardar
   *   Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); ; ruta para editar;
   *   Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); ruta para actualizar
   *   Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); ruta para eliminar 
  *    Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search'); ruta para buscar;
 *     
 * 
 * Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google'); ruta para redireccionar con google 
 * Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']); ruta para redireccionar con google 

 * Route::get('login', function () {    return Inertia::render('Auth/Login');})->name('login'); ruta para login con google 

 *  Route::get('/posts/{post}/logs', [LogController::class, 'index'])->name('posts.logs'); ruta para ver los logs 
 * )
 */

 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
});

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/posts/{post}/logs', [LogController::class, 'index'])->name('posts.logs');

Route::get('/', function () {
    return inertia('Welcome');
});