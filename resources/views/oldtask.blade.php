@extends('layouts.header')


@section('content')


    <div id="page-wrapper">
        <div id="history">
            
            <flash-message text="{{ session('flash') }}"></flash-message>

            <a href="{{ Route("$items") }}/create"> <button type="button" class="btn btn-primary">Create {{ rtrim($items,"s") }}</button> </a>

            {{-- ROW 1 - TITLE --}}
            <div class="row"> 
                <div class="col-md-12">
                    <h1 class="page-head-line">  {{ $items }} editing history</h1>
                    <h1 class="page-subhead-line">There are last editing  {{ $items }}. </h1>
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
                                        <?php  if ( $table_item == "task_id") $table_item = "ID";  ?>
                                        <?php  if ( $table_item == "user_id") $table_item = "User";  ?>
                                        <?php  if ( $table_item == "client_id") $table_item = "Client";  ?>
                                        <?php  if ( $table_item == "project_id") $table_item = "Project";  ?>
                                        <?php  if ( $table_item == "now") $table_item = "Last edit";  ?>
                                        <th style="text-transform:capitalize">{{ $table_item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($collection as $key=>$item)
                                            <tr>
                                            {{-- @include("layouts.single-layout") --}}
                                            @foreach ($table as $key=>$table_item)
                                                <td class="tdtext" style="max-width:400px" value="{{$item->$table_item}}">{{ $item->$table_item }}</td>                                                    
                                            @endforeach
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

