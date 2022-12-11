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
        return view ('layouts.index-layout', [
            'collection' =>  Task::latest()->get(),
            'items' => 'tasks',
            'table'  => ['id','title','description', 'priority', 'status', 'user_id', 'client_id', 'project_id'],
            
            'messages' => Message::all(),
            'users' => User::get(),
            'clients' => Client::get(),

            'projects_number' =>  Project::whereNot('status', 'close')->get()->count() ,
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

        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admins_list [] = $admin->email; 
        }
       
        Mail::to($admins_list)->send(new TestEmail($task));

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
            return  redirect('tasks')->with('flash' , "Project permanently deleted");;
        }

        $task->delete()->with('flash' , "Project deleted");;
        
    }

    public function archive()
    {
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
        return view ('layouts.index-layout', [
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


    /*
    GET DATA ABOUT TASKS / TASKS API
    */
    public function task_api( Request $request, Task $task)
    {

        // set task by request
        if ( $request->status ) {   // if have status
            $task = Task::where('title', $request->name)->where('status', $request->status)->limit($request->limit)->get();
        }
        else if ( $request->priority ) {   // if have  priority
            $task = Task::where('title', $request->name)->where('priority', $request->priority)->limit($request->limit)->get();
        }
        else {  // if have onle task name
            $task = Task::where('title', $request->name)->limit($request->limit)->get();
        }
      
    
        // set responsies
		$priority_array = ['1 - low', '2 - medium', '3- hight'];
        if ( $request->priority && !in_array( $request->priority, $priority_array ) ){   // respons if not have correct priority
            return  response()->json(['message'=>'Wrong priority value'],417);
        }  
        if ( !$task || empty($request->name) || count($task) < 1 || !$request->name ) { // respons if not found
            return response()->json(['message'=>'task not found'], 404);
        }
 

        return $task;
    }


    
}
