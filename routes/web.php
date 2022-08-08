<?php

use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => '\\App\\Http\\Controllers',
        'middleware' => ['web', 'admin'],
    ],
    function () {
        Route::resource('course', 'CourseController');
        Route::resource('article', 'ArtikelController');
    }
);
Route::group(
    [
        'prefix' => '/',
        'namespace' => '\\App\\Http\\Controllers',
       // 'middleware' => ['web', 'admin'],
    ],
    function () {
        Route::get('/', 'UserController@login')->name('login.user');;
        Route::get('register', 'UserController@register')->name('register.user');
        Route::get('user', 'UserController@user')->name('user.user');
        Route::get('course', 'UserController@course')->name('course.user');
        Route::get('artikel', 'UserController@artikel')->name('artikel.user');
    }
);

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/', function () {
//     return view('user');
// });
// Route::get('/', function () {
//     return view('mentor');
// });