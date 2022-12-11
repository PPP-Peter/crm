<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Response;
use App\Http\Controllers\Api\AuthController;



class UserController extends Controller
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;


   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {
        return view('users.index', [
            'mena' =>  User::latest()->paginate(15),  
            'projects_number' =>  Project::latest('deadline')->get()->count(),
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(),
            'user' => Role::all(),
            'messages' => Message::all(),
            'admins'=> User::role('admin')->get(),
            'roles'=> Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return  redirect('users');
    }

    /*prida rolu */
    public function assignRole( Request $request, User $user)
    {
        if($user->hasRole($request->role)){
            return back()->with('flash', 'Role exist');
        }
        $user->assignRole($request->role);
        return  back()->with('flash', 'Role assigned');
    }

    /* odstrani rolu */ 
    public function removeRole( Request $request, User $user)
    {
        if(!$user->hasRole($request->role)){
            return back()->with('flash', 'Role not exist');
        }
        $user->removeRole($request->role);
        return  back()->with('flash', 'Role remove');
    }

    /* prida povolenie */
    public function givePermission( Request $request, User $user)
    {
        if($user->hasPermissionTo($request->permission)){
            return back()->with('flash', 'permission exist');
        }
        $user->givePermissionTo($request->permission);
        return  back()->with('flash', 'Role assigned');
    }

    



    






}
