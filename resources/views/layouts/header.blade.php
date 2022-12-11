<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('../resources/img/favicon.png') }}" />
    <title>{{ config('app.name', 'Login') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- FONTS AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- DASHICONS-->
    <link href="{{ asset('../node_modules/@icon/dashicons/dashicons.css') }}" rel="stylesheet">

     <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body id="app" class="{{ Request::segment(1) }}"  >
   
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" @click="toggle" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ Route('home') }}">CRM</a>
            </div>
           

            @if (isset ( $projects_number ) )
                <div class="header-right">
                    <a href="{{ Route('tasks') }}" class="btn btn-primary" title="Open Tasks"><b>{{$tasks_number}} </b><i class="fa fa-bars "></i></a>
                    <a href="{{ Route('projects') }}" class="btn btn-info" title="Not close projects"><b>{{$projects_number}} </b><i class="fas fa-bell "></i></a>
                    <a href="{{ Route('home') }}#chat" class="btn btn-danger" title="Messages"><b>{{count($messages)}} </b><i class="fa fa-exclamation-circle "></i></a>
                </div>
            @endif

            <div class="header-left min-menu">
                <i class="fas fa-2x fa-bars"   @click="minimalize"></i>
            </div>
           
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation" v-show="isActive">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <i class="fas fa-2x fa-user-circle"></i>

                            <div class="inner-text" style="text-transform: capitalize">
                                {{ Auth::user()->name }}
                            <br>
                                <i><small style="font-weight:normal">Role: 
                                    @foreach (Auth::user()->getRoleNames() as $role)
                                        <span style="text-transform: capitalize">{{$role}}</span>
                                    @endforeach
                                </small></i>

                                <div class="" > 
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                               <button>{{ __('Logout') }}  <i class="fas fa-sign-out-alt"></i></button> 
                                            </a> 
            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                </div>

                                <small class="get-token" @click.stop.prevent="updatePost()">get token</small>
                                
                                <!-- The Modal -->
                                <div id="myModal" v-if="token" class="modal-token" @dblclick="zavriToken()">
                                    <div class="modal-content">
                                    <span  @click="zavriToken()" class="close">&times;</span>
                                    <p>Tu je tvoj API TOKEN: <br><br>
                                        <span class="token">@{{info}}</span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li> 
                        <a class="{{ Request::segment(1)  !== 'home' ?: 'active-menu'  }} " href="{{ Route('home') }}">
                            <i class="dashicons dashicons-dashboard"></i> <span>Dashboard </span>
                        </a> 
                    </li>
                    <li> 
                        <a class="{{ Request::segment(1)  !== 'clients' ?: 'active-menu'  }}" href="{{ Route('clients') }}"> 
                            <i class="fas fa-id-card"></i> <span>Clients</span>
                        </a>
                     </li>
                    <li> 
                        <a class="{{ Request::segment(1)  !== 'users' ?: 'active-menu'  }}" href="{{ Route('users') }}">
                             <i class="dashicons dashicons-admin-users"></i> <span>Users</span> 
                        </a>
                    </li>
                    <li> 
                        <a class="{{ !strpos($_SERVER['REQUEST_URI'] , 'projects') ?: 'active-menu'  }}" href="{{ Route('projects') }}"> 
                            <i class="dashicons dashicons-admin-page"></i> <span>Projects</span> 
                        </a> 
                    </li>
                    <li> 
                        <a class="{{ !strpos($_SERVER['REQUEST_URI'] , '/tasks') ?: 'active-menu'  }}" href="{{ Route('tasks') }}">
                         <i class="fas fa-tasks"></i> <span>Tasks</span> 
                        </a> 
                        <ul class="nav nav-second-level" >
                            <li>
                                <a style="padding:9px" class="{{ !strpos($_SERVER['REQUEST_URI'] ,'/oldtasks') ?: 'active-menu'  }}" href="{{ Route('history') }}">
                                    <i class="fa fa-history"></i><span>Tasks history</span></a>
                            </li>
                        </ul>
                    </li>
                    <li> 
                        <a class="{{ !strpos($_SERVER['REQUEST_URI'] ,'gallery') ?: 'active-menu'  }}" href="{{ Route('gallery') }}"> 
                            <i class="fa fa-image"></i> <span>Gallery</span> 
                        </a> 
                    </li>
                  
                </ul>

            </div>

        </nav>

        <div >
            @yield('content')
        </div>
    </div>

        <!--  FOOTER  -->
        <div id="footer-sec">
            &copy; 2022 Peter Maník
        </div>

    
    
    </body>
    </html>