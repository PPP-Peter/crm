@extends('layouts.header')


@section('content')

        <div id="page-wrapper">
            <div id="page-inner">


{{-- 
    Check roles and permissions 
--}}
 {{-- {{Auth::user()->getRoleNames() }}
{{Auth::user()->can('edit tasks')}} --}}



            <flash-message text="{{ session('flash') }}"></flash-message>

                {{-- ROW 1 - TITLE --}}
                <div class="row"> 
                    <div class="col-md-12">
                        <h1 class="page-head-line">Users</h1>
                        <h1 class="page-subhead-line">These are current users. </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        @role('user')
                            <p>Obsah sa zobrazuje iba užívateľom s rolou admin alebo manager.</p>   
                        @endrole

                        @role(['admin','manager'])
                        @can('edit tasks')

                         {{-- TABLE --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Register</th>
                                        <th>Email verification</th>
                                        <th>Role</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mena as $meno)
                                        <tr>
                                            <td>{{ $meno->id }}</td>
                                            <td>{{ $meno->name }}</td>
                                            <td>{{ $meno->email }}</td>
                                            <td> {{ $meno->created_at }} </td>
                                            <td> {{ $meno->email_verified_at }} </td>
                                            <td>
                                                @foreach ($meno->getRoleNames() as $role)
                                                <span style="background:#E89158; padding:4px">{{$role}}</span>
                                                @endforeach
                                                @foreach ($meno->getPermissionNames() as $permission)
                                                   <span style="background:#00CA79;padding:4px"> {{$permission}}</span>
                                                    {{-- {{ $meno->givePermissionTo(['read tasks']) }} --}}
                                                @endforeach
                                            </td>
                                                <td>
                                                    
                                                    @can('delete tasks')
                                                        <div class="input-title" >Role</div>
                                                        <select class="form-control status" name="role" v-model="role">
                                                            <option  value="admin"> admin </option>
                                                            <option  value="manager"> manager </option>
                                                            <option  value="writer"> writer </option>
                                                            <option  value="user"> user </option>
                                                        </select>

                                                        <span style="display:flex">
                                                        
                                                            <form action="{{route('users')}}/role/{{$meno->id}}" method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="role" :value="this.role"></input>
                                                                <button type="submit" class="label label-info" href=""> Add </button> 
                                                            </form>
                                                            <form action="{{route('users')}}/role/{{$meno->id}}" method="POST">
                                                                <input type="hidden" name="role" :value="this.role"></input>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"  class="label label-danger"> Delete </button> 
                                                            </form>
                                                        
                                                        </span>
                                                    @endcan

                                                    @can('edit tasks') 
                                                        <form action="{{route('users')}}/permission/{{$meno->id}}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <select class="form-control status" name="permission">
                                                                <option  value="read tasks"> read tasks </option>
                                                                <option  value="edit tasks"> edit tasks </option>
                                                                <option  value="create tasks"> create tasks </option>
                                                                <option  value="delete tasks"> delete tasks </option>
                                                            </select>
                                                            <button type="submit"  class="label label-warning" href="" > give permission </button> 
                                                        </form>
                                                    @endcan

                                                    @can('delete tasks')
                                                        <form action="{{route('users')}}/{{$meno->id}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"  class="label label-danger"> delete user </button> 
                                                        </form>
                                                    @endcan
                                                </td>
                                        </tr>
                                    @endforeach
                                  
                                </tbody>
                            </table>
                        </div>
						{{$mena->links()}}
	
                        @endrole
                       
                        @endcan

                    </div>
                </div>

            </div>
        </div>


    @endsection