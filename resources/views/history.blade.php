@extends('layouts.header')


@section('content')


    <div id="page-wrapper">
        <div id="index">
            
            <flash-message text="{{ session('flash') }}"></flash-message>

            <a href="{{ Route("$items") }}/create"> <button type="button" class="btn btn-primary">Create {{ rtrim($items,"s") }}</button> </a>

            {{-- ROW 1 - TITLE --}}
            <div class="row"> 
                <div class="col-md-12">
                    <h1 class="page-head-line"> History {{ $items }}</h1>
                    <h1 class="page-subhead-line">These are current {{ $items }}. </h1>
                </div>
            </div>

      
            <div class="row">
                <div class="col-md-12">

                 
                    
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

