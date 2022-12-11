<?php

namespace App\Http\Controllers;

use App\Models\Oldtask;
use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;


class OldtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('oldtask', [
            'collection' =>  Oldtask::latest('now')->limit(25)->get(),
            'now' =>  Oldtask::get(),
            'items' => 'tasks',
            'table'  => ['now','task_id','title','description', 'priority', 'status', 'user_id', 'client_id', 'project_id', ],
            
            'messages' => Message::all(),
            'users' => User::get(),
            'clients' => Client::get(),

            'projects_number' =>  Project::whereNot('status', 'close')->get()->count() ,
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(),        
          ]);

    }

    
}
