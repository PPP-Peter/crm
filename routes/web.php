<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
use App\Models\User;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
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

// verified prepisat do controllerov
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('verified');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('verified');

/* projects */
Route::post('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'restore'])->withTrashed();   // restore
Route::get('/projects/archive', [App\Http\Controllers\ProjectController::class, 'archive'])->name('projects-archive'); // archive
Route::resource('/projects', App\Http\Controllers\ProjectController::class); // resource
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects'); // index
Route::get('/projects/filter/{status}', [App\Http\Controllers\ProjectController::class, 'projects_status']); // filter status
Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])->withTrashed(); // delete

/* clients */
Route::post('/clients/{client}', [App\Http\Controllers\ClientController::class, 'restore'])->withTrashed();
Route::get('/clients/archive', [App\Http\Controllers\ClientController::class, 'archive'])->name('clients-archive');
Route::resource('/clients', App\Http\Controllers\ClientController::class)->except(['archive', 'index', 'destroy']);
Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients');
Route::delete('/clients/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->withTrashed();

/* tasks */
Route::post('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'restore'])->withTrashed();
Route::get('/tasks/archive', [App\Http\Controllers\TaskController::class, 'archive'])->name('tasks-archive');
Route::resource('/tasks', App\Http\Controllers\TaskController::class);
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/filter/{status}', [App\Http\Controllers\TaskController::class, 'tasks_status']); // filter status
Route::delete('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->withTrashed();
/* tasks edit history */
Route::get('/oldtasks', [App\Http\Controllers\OldtaskController::class, 'index'])->name('history');  // history


/* mesages */ 
Route::resource('/messages', App\Http\Controllers\MessageController::class);
Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages');


/* emails */ 
Route::get('/mail-notification', function () {    // mail-notification pre zobrazenie
    return view ('mail-notification', );
})->middleware('verified');;
 
Route::get('send-email/{mail_data}', function($mail_data){   // test send-email pre poslanie 
    $to = ['m.peter.k15@gmail.com' , 'p.petermanik@gmail.com'];

    // $mailData = [
    //     "name" => "Test NAME",
    //     "dob" => "12/12/1990",
    //     'mail' => 'skuska',
        
    // ];

    Mail::to($to)->send(new TestEmail($mail_data));

    dd("mail");
})->name('mail-not')->middleware('verified');



/* tasks edit history */ 
Route::post('/task-history/{task_id}/{title}/{description}/{status}/{priority}/{user_id}/{client_id}/{project_id}', function ($task_id, $title, $description, $status, $priority, $user_id, $client_id, $project_id) {

    DB::table('oldtasks')->insert(
        array(
            'task_id' => $task_id, 
            'title' => $title, 
            'description' => $description,
            'status' => $status, 
            'priority' => $priority,
            'user_id' => $user_id,
            'client_id' => $client_id, 
            'project_id' => $project_id,
        )
    );

    return;
});






