<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;


class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Client::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view ('layouts.index-layout', [   // namiesto  clients.index
            'collection' =>  Client::all(),
            // 'open_projects' => Client::with('projects')->get(),  //->where('status', 'open')->count()
            'items' => 'clients',
            'table'  => ['id','Company','Address','VAT'],
            'messages' => Message::all(),
            
            'users' => User::get(),
            'projects_number' =>  Project::get()->count(),
            'tasks_number' =>  Task::get()->where('status', 'open')->count(),
            'clients_number' =>  Client::all()->count(),        
          ]);
    }

    public function archive()
    {
         //return Client::all();
        return view ('clients.archive', [
            'collection' =>  Client::all(),
            'table'  => ['id','Company','Address','VAT', 'deleted_at'],
            'items' => 'clients',
            'archive' =>  Client::onlyTrashed()->orderBy('deleted_at', 'desc')->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('clients.create', [
            'item' => 'client',
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
            'Company'=>'required',
            'Address'=>'required',
            'VAT'=>'required|integer',
        ]);

        Client::create(
            $request->all()
        );
          
        return redirect('clients')->with('flash' , 'Added new Client');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', [
            'items' => 'clients',
            'item' => $client,
            'table'  => ['id','Company','Address','VAT'],
            
        ]);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->Company = $request->Company;
        $client->Address = $request->Address;
        $client->VAT = $request->VAT;
        $client->save();

        return redirect('clients')->with('flash' , 'Update Client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->trashed()){
            $client->forceDelete();
            return  redirect('clients');
        }
        
       $client->delete();
    }

    public function restore(Client $client, Request $request )
    {

         $client->restore();
         return redirect('clients')->with('flash' , "Restore client");

    }
}
