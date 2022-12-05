<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('tasks.index', [
            'collection' =>  Task::all(),
            'items' => 'tasks',
            'table'  => ['id','title','description', 'priority', 'status', 'user_id', 'client_id', 'project_id'],
            'messages' => Message::all(),
            'users' => User::get(),
            'clients' => Client::get(),
            'projects_number' =>  Project::get()->count(),
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(),        
          ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('tasks.create', [
            'item' => 'task',
            'projects' =>  Project::all(),
            'users' => User::all(),
            'tasks' => Task::all(),
            'clients' => Client::all(),
            ]);
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        Task::create(
            $request->all()
        );
          
        return redirect('tasks')->with('flash' , 'Added new Task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'items' => 'tasks',
            'item' => $task,
            'table'  => ['id','title','description', 'priority', 'status', 'user_id', 'client_id', 'project_id'],
            'users' => User::get(),
            'clients' => Client::get(),
            'projects' => Project::get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        $task->status = $request->status;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->client_id = $request->client_id;
        $task->user_id = $request->user_id;
        $task->project_id = $request->project_id;
        $task->save();

        $admins= ['m.peter.k15@gmail.com' ];  //, 'p.petermanik@gmail.com'
        Mail::to($admins)->send(new TestEmail($task));

        return redirect('tasks')->with('flash' , 'Update Task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->trashed()){
            $task->forceDelete();
            return  redirect('tasks');
        }

        $task->delete();
        
    }

    public function archive()
    {
         //return task::all();
        return view ('tasks.archive', [
            'collection' =>  Task::all(),
            'table'  => ['id','title','description', 'priority', 'status', 'user_id', 'client_id', 'project_id', 'deleted_at'],
            'items' => 'tasks',
            'archive' =>  task::onlyTrashed()->orderBy('deleted_at', 'desc')->get(),

        ]);
    }

    public function restore(Task $task, Request $request )
    {

         $task->restore();
         return redirect('tasks')->with('flash' , "Restore Task");

    }


    public function tasks_status($status)
    {
        return view ('tasks.index', [
            'collection' =>  Task::where('status', $status)->get(),
            'items' => 'tasks',
            'table'  => ['id','title','description', 'priority', 'status', 'user_id', 'client_id', 'project_id'],
            'messages' => Message::all(),
            'users' => User::get(),
            'clients' => Client::get(),
            'projects_number' =>  Project::get()->count(),
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(),        
          ]);

    }


    
}
