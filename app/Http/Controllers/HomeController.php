<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
use App\Models\User;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $week=strtotime("-7 days");
        $time_now = date("Y/m/d", $week);

        return view('dashboard', [
            'mena' =>  \DB::table('users')->latest()->take(5)->get(),
            'projects' =>  Project::all(),
            'users' => User::all(),
            'tasks' => Task::all(),
            'clients' => Client::all(),
            'messages' => Message::all(),
            
            'projects_number' =>  Project::latest('deadline')->where('status', ['open'])->get()->count() + Project::latest('deadline')->where('status', ['waiting'])->get()->count(),
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(),
            'new_clients' => Client::whereDate('created_at', '>', $time_now)->count(),
            'new_projects' => Project::whereDate('created_at', '>', $time_now)->count(),
            'new_tasks' => Task::whereDate('created_at', '>', $time_now)->count(),
        ]);
    }
}
