@extends('layouts.header')


@section('content')


     
        <div id="page-wrapper">
            <div id="page-inner">

                {{-- ROW 1 - TITLE --}}
                <div class="row"> 
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                        <h1 class="page-subhead-line">This is your dashboard. </h1>
                    </div>
                </div>

               {{-- ROW 2 - 3 PANNELS--}}
                <div class="row"> 
                    <div class="col-md-4">
                        <a href="{{ route('projects') }}" class="white-text">
                            <div class="main-box mb-red">
                                <i class="fa fa-file fa-5x"></i>
                                    <h5>{{ $projects_number }} Projects</h5>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-4">
                        <a href="{{ route('tasks') }}" class="white-text">
                            <div class="main-box mb-dull">
                                    <i class="fas fa-tasks fa-5x"></i>
                                    <h5>{{ $tasks_number }} Tasks In Check</h5>
                            </div>
                        </a>
                    </div>
               
                    <div class="col-md-4">
                        <a href="{{ route('clients') }}" class="white-text">
                            <div class="main-box mb-pink">
                            
                                    <i class="fas fa-user fa-5x"></i>
                                    <h5>{{ $clients_number }} Clients</h5>
                            </div>
                        </a>
                    </div>
                </div>

             

               {{-- ROW 3 --}}
                <div class="row">
                    <div class="col-md-8">
                         {{-- MESSAGE --}}
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <h4 class="list-group-item-heading">AUTOR: PETER MANÍK </h4>
                                <p class="list-group-item-text" style="line-height: 30px;">
                                    Built with laravel and Vue. Try creating a new task or adding a new client. 
                                </p>
                            </a>
                        </div>

                         {{-- TABLE --}}
                        <div class="table-responsive">
                            <h4> Users list </h4>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Register</th>
                                        <th>Email verification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mena as $meno)
                                        <tr>
                                            <td>{{ $meno->id }}</td>
                                            <td>{{ $meno->name }}</td>
                                            <td>{{ $meno->email }}</td>
                                            <td>{{ convertDate($meno->created_at) }}</td>
                                            <td>{{ convertDate($meno->email_verified_at) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    


                    {{-- NOTIFICATIONS PANEL  --}}
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i>Notifications Panel
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-user fa-fw"></i> {{ $new_clients }} New Clients
                                        <span class="pull-right text-muted small"><em>from last week</em></span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-bolt fa-fw"></i> {{ $new_projects }} New Projects
                                        <span class="pull-right text-muted small"><em>from last week</em></span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fas fa-tasks"></i> {{ $new_tasks }} New Tasks
                                        <span class="pull-right text-muted small"><em>from last week</em></span>
                                    </a>
                                </div>
                                <a href="#" class="btn btn-info btn-block">View All Alerts</a>
                            </div>
                        </div>
                    </div>
                 </div> 


                
                <hr />
                 {{-- ROW 4 --}}
                <div class="row" style="padding-bottom: 100px; `">
                    
                    @can('create tasks')
                    {{--  FORM --}}
                    <div class="col-md-6">
                        <div id="comments-sec">
                
                                    <h3> Create new task <i class="fas fa-pencil-alt prefix"></i> </h3>
                                    <form action="{{route('tasks')}}" method="POST" class="createform">
                                        @csrf
                                    
                                        <div class="md-form amber-textarea active-amber-textarea-2">
                                            
                                            <new-task-part date="{{date('Y-m-d H:i:s')}}" :clients="{{$clients}}" :users="{{$users}}"  :projects="{{$projects}}"/>
                                            
                                        </div>
                                    </form>
                
                        </div>
                        @endcan
                    </div>

                    {{--  CHAT--}}
                    <div class="col-md-6" style="height:440px;" id="chat">
                        <div class="panel panel-default" >
                            <div class="panel-heading">
                                Recent Chat History
                            </div>
                            <div class="panel-body" style="padding: 0px;">
                                <div class="chat-widget-main">

                                    @foreach ($messages as $message)
                                        <div class="chat-widget-left">
                                           {{ $message->message }}
                                        </div>
                                        
                                        <div class="chat-widget-name-left">
                                            <h4>{{ $message->user->name }} <small>{{ $message->created_at->diffForHumans() }}</small></h4> 
                                        </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                            <form class="panel-footer" action="{{route('messages')}}" method="POST" >
                                @csrf
                                <div class="input-group">
                                    <input name="message" type="text" class="form-control" placeholder="Enter Message" />
                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}"> 
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="send">SEND</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->



    @endsection