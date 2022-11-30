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

/*
ak je uzivatel prihlaseny presmruje na domov inak na login
*/
Route::get('/', function () {
    if( Auth::user() !== null )
    {
        return view('welcome');
    }
    else
    {
        return redirect('/login');
    }

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
