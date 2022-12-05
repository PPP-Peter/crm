@extends('layouts.header')


@section('content')

        <div id="page-wrapper">
            <div id="page-inner">
{{-- {{Auth::user()->getRoleNames() }}
{{Auth::user()->can('edit articles')}} --}}

{{-- @dd(Auth::user()) --}}
{{-- {{$user}} --}}
                {{-- ROW 1 - TITLE --}}
                <div class="row"> 
                    <div class="col-md-12">
                        <h1 class="page-head-line">Users</h1>
                        <h1 class="page-subhead-line">These are current users. </h1>
                    </div>
                </div>

             

                <div class="row">
                    <div class="col-md-12">

                        @role('admin')
                        {{-- @can('edit articles') --}}

                         {{-- TABLE --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>E-mail</th>
                                        {{-- <th>Register</th> --}}
                                        <th>Email verification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mena as $meno)
                                        <tr>
                                            <td>{{ $meno->id }}</td>
                                            <td>{{ $meno->name }}</td>
                                            <td>{{ $meno->email }}</td>
                                            {{-- <td> </td> --}}
                                            <td> {{ convertDate( $meno->created_at) }} </td>
                                            <td> {{ convertDate( $meno->email_verified_at ) }} </td>
                                        </tr>
                                    @endforeach
                                  
                                </tbody>
                            </table>
                        </div>
                        @endrole
                       
                        {{-- @endcan --}}

                    </div>
                </div>

            </div>
        </div>


    @endsection