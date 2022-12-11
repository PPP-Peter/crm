<?php

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Mail\TestEmail;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\User as Authenticatable;
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


// verified prepisat do controllerov
Auth::routes(['verify' => true]);

/* home */ 
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('verified');

/* users */ 
Route::middleware(['verified'])->group(function (){
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/role/{user}', [UserController::class, 'assignRole'])->name('users.assign');
    Route::post('/users/permission/{user}', [UserController::class, 'givePermission']);
    Route::delete('/users/role/{user}', [UserController::class, 'removeRole'])->name('role.destroy');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

/* projects */
Route::middleware(['verified'])->group(function (){
    Route::post('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'restore'])->withTrashed();   // restore
    Route::get('/projects/archive', [App\Http\Controllers\ProjectController::class, 'archive'])->name('projects-archive'); // archive
    Route::resource('/projects', App\Http\Controllers\ProjectController::class); // resource
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects'); // index
    Route::get('/projects/filter/{status}', [App\Http\Controllers\ProjectController::class, 'projects_status']); // filter status
    Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])->withTrashed(); // delete
});

/* clients */
Route::middleware(['verified'])->group(function (){
    Route::post('/clients/{client}', [App\Http\Controllers\ClientController::class, 'restore'])->withTrashed();
    Route::get('/clients/archive', [App\Http\Controllers\ClientController::class, 'archive'])->name('clients-archive');
    Route::resource('/clients', App\Http\Controllers\ClientController::class)->except(['archive', 'index', 'destroy']);
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients');
    Route::delete('/clients/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->withTrashed();
});

/* tasks */
Route::middleware(['verified'])->group(function (){
    Route::post('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'restore'])->withTrashed();
    Route::get('/tasks/archive', [App\Http\Controllers\TaskController::class, 'archive'])->name('tasks-archive');
    Route::resource('/tasks', App\Http\Controllers\TaskController::class);
    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/filter/{status}', [App\Http\Controllers\TaskController::class, 'tasks_status']); // filter status
    Route::delete('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->withTrashed();
    /* tasks edit history */
    Route::get('/oldtasks', [App\Http\Controllers\OldtaskController::class, 'index'])->name('history');  // history
});


/* mesages */ 
Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages');
Route::post('/messages', [App\Http\Controllers\MessageController::class, 'store']);


/* Emails */ 
Route::get('/mail-notification', function () {    // mail-notification pre zobrazenie
    return view ('mail-notification', );
})->middleware('verified');;
 
Route::get('send-email/{mail_data}', function($mail_data){   // test send-email pre skusobne poslanie mne
    $to = ['m.peter.k15@gmail.com' , 'p.petermanik@gmail.com'];

    // $mailData = [
    //     "name" => "Test NAME",
    //     "dob" => "12/12/1990",
    //     'mail' => 'skuska',  
    // ];

    Mail::to($to)->send(new TestEmail($mail_data));

    dd("mail");
})->name('mail-not')->middleware('verified');


// GALLERY
Route::get('/gallery', function () {    
    return view ('gallery',[
        'clients' =>  Client::all()
    ] );
})->middleware('verified')->name('gallery');


/* add to tasks  history after edit*/ 
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
})->middleware('verified');



// API USERS
Route::get('/user-json', function () { 
    return Response::json([   
        'user' => Auth::user(),
         'users' =>  User::all(),
         'token' =>  Auth::user()->createToken('authToken')->plainTextToken,
        ]);   
})->middleware('auth:sanctum');

// API TASKS
Route::get("/task_api",[TaskController::class,'task_api'])->middleware('auth:sanctum');

// GET TOKEN
Route::get('/profile', function () { 
    return view ('users.profile');
});  // overenie je uz vo fukncii













