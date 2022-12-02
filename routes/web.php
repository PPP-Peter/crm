<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
use App\Models\User;
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
Ak je uzivatel prihlaseny presmruje na domov, inak na login
*/


Route::get('/', function () {
    if( Auth::user() !== null )
    {
        return redirect('dashboard');
    }
    else
    {
        return redirect('/login');
    }
})->middleware('verified');


// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('verified');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('verified');

Route::resource('/projects', App\Http\Controllers\ProjectController::class)->middleware('verified');
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects')->middleware('verified');

Route::resource('/clients', App\Http\Controllers\ClientController::class)->middleware('verified');
Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients')->middleware('verified');

Route::resource('/tasks', App\Http\Controllers\TaskController::class)->middleware('verified');
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks')->middleware('verified');


// Route::get('/projects/new', function () {
// return view ('projects.new', [
//     'projects' =>  Project::latest('deadline')->get(),
//     'users' => User::all(),
//     'clients' => Client::all(),
//     ]);
// });





