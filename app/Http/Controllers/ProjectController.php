<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{

    public function __constructor()
    {
   
    }


    public function projects_status($status)
    {
        
        return view('projects.index', [
            'collection' =>  Project::where('status', $status)->get(),
            'items' => 'projects',
            'table'  => ['id','title','deadline','description', 'status', 'user', 'client'],
            'messages' => Message::all(),
            'users' => User::get(),
            'clients' => Client::all(),
            'projects_number' =>  Project::get()->count(),
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(), 
          ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('projects.index', [
            'collection' =>  Project::all(),
            'items' => 'projects',
            'table'  => ['id','title','deadline','description', 'status', 'user', 'client'],
            'messages' => Message::all(),
            // 'active_projects' => Project::get()->where('status', 'open'),

            'users' => User::get(),
            'clients' => Client::all(),
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
        return view ('projects.create', [
            'item' => 'project',
            'projects' =>  Project::latest('deadline')->get(),
            'users' => User::all(),
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
            'deadline' => 'required',
        ]);

        Project::create(
            $request->all()
        );
          
        return redirect('projects')->with('flash' , 'Added new Project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', [
            'items' => 'projects',
            'item' => $project,
            'table'  => ['id','title','description', 'deadline','status', 'user_id', 'client_id'],
            'users' => User::get(),
            'clients' => Client::get(),
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->client_id = $request->client_id;
        $project->user_id = $request->user_id;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->save();

        //  $admins= ['m.peter.k15@gmail.com' , 'p.petermanik@gmail.com'];
        //  Mail::to($admins)->send(new TestEmail('data'));
  

        return redirect('projects')->with('flash' , 'Update Project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->trashed()){
            $project->forceDelete();
            return  redirect('projects');
        }

        $project->delete();
    }

    public function archive()
    {
         //return project::all();
        return view ('projects.archive', [
            'collection' =>  project::all(),
            'table'  => ['id','title','deadline','description', 'status', 'user', 'client', 'deleted_at'],
            'items' => 'projects',
            'archive' =>  project::onlyTrashed()->orderBy('deleted_at', 'desc')->get(),

        ]);
    }

    public function restore(Project $project, Request $request )
    {

         $project->restore();
         return redirect('projects')->with('flash' , "Restore project");

    }
}
