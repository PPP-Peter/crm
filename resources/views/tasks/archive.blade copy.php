@extends('layouts.header')


@section('content')


    <div id="page-wrapper">
        <div id="archive">

            <flash-message text="{{ session('flash') }}"></flash-message>


            {{-- ROW 1 - TITLE --}}
            <div class="row"> 
                <div class="col-md-12">
                    <h1 class="page-head-line"> {{ $items }}</h1>
                    <h1 class="page-subhead-line">These are current {{ $items }}. </h1>
                </div>
            </div>

      
            <div class="row">
                <div class="col-md-12">

                    <a  href="{{ route("$items") }}">active</a>&nbsp&nbsp&nbsp
                    <a style="font-weight:bold" href="{{ route("$items") }}">trash</a>
         
                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    @foreach ($table as $table_item)
                                        <?php  if ( $table_item == "user_id") $table_item = "User";  ?>
                                        <?php  if ( $table_item == "client_id") $table_item = "Client";  ?>
                                        <?php  if ( $table_item == "project_id") $table_item = "Project";  ?>
                                        <?php  if ( $table_item == "deleted_at") $table_item = "Deleted";  ?>
                                        <th style="text-transform:capitalize">{{ $table_item }}</th>
                                    @endforeach
                                    <th>Options</th>
                                </tr>
                               
                            </thead>
                            <tbody>
                                    @foreach ($archive as $key=>$item)
                                            <tr>
                                                @include("layouts.single-layout")

                                                <td>
                                                    <a  class="post{{$item->id}} label label-danger" @click.stop.prevent="deletePost({{$item->id}})" > delete </a> &nbsp&nbsp
                                                    <form action="{{ route("$items") }}/{{$item->id}}" method="POST">
                                                        @csrf
                                                        {{-- @method('DELETE') --}}
                                                        <button class="btn btn-warning"> restore </button>
                                                    </form>
                                                    {{-- <a  class="post{{$item->id}} label label-warning" href="{{Route("$items")}}/{{ $item->id }}" > obnova </a>  --}}
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

