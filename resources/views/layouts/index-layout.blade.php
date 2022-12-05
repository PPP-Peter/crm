@extends('layouts.header')


@section('content')


    <div id="page-wrapper">
        <div id="index">
            
            <flash-message text="{{ session('flash') }}"></flash-message>

            <a href="{{ Route("$items") }}/create"> <button type="button" class="btn btn-primary">Create {{ rtrim($items,"s") }}</button> </a>

            {{-- ROW 1 - TITLE --}}
            <div class="row"> 
                <div class="col-md-12">
                    <h1 class="page-head-line"> {{ $items }}</h1>
                    <h1 class="page-subhead-line">These are current {{ $items }}. </h1>
                </div>
            </div>

      
            <div class="row">
                <div class="col-md-12">

                 
                    <a class="active" href="{{ route("$items") }}"><i class="fa fa-check"></i>  all</a> &nbsp&nbsp&nbsp
                    @if (  Request::segment(1) == 'projects' ||  Request::segment(1) == 'tasks' )
                        <a href="{{ route("$items") }}/filter/open"><i class="fas fa-folder-open"></i> open</a> &nbsp&nbsp&nbsp
                        <a href="{{ route("$items") }}/filter/close"><i class="fas fa-lock"></i> close </a> &nbsp&nbsp&nbsp
                            @if (  Request::segment(1) == 'projects' )
                                <a href="{{ route("$items") }}/filter/waiting"><i class="fas fa-pause"></i> waiting </a>&nbsp&nbsp&nbsp
                            @endif
                    @endif
                    <a href="{{ route("$items-archive") }}"><i class="fa fa-trash"></i> trash</a>
                    
                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    @foreach ($table as $table_item)
                                        <?php  if ( $table_item == "user_id") $table_item = "User";  ?>
                                        <?php  if ( $table_item == "client_id") $table_item = "Client";  ?>
                                        <?php  if ( $table_item == "project_id") $table_item = "Project";  ?>
                                        <th style="text-transform:capitalize">{{ $table_item }}</th>
                                    @endforeach
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($collection as $key=>$item)
                                            <tr>
                                                @include("layouts.single-layout")

                                                <td>
                                                    <a class="label label-info" href="{{Route("$items")}}/{{ $item->id }}/#show"> view </a> &nbsp&nbsp
                                                    <a  class="post{{$item->id}} label label-warning" href="{{Route("$items")}}/{{ $item->id }}" > edit </a> &nbsp&nbsp
                                                    <a  class="post{{$item->id}} label label-danger" @click.stop.prevent="deletePost({{$item->id}})" > delete </a> 
                                                </td>
                                            </tr>
                                    @endforeach
                            </tbody>

                           
                        
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

