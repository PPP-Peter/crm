@extends('layouts.header')


@section('content')

<div id="page-wrapper">
    <div id="page-inner">

        <flash-message text="{{ session('flash') }}"></flash-message>

        {{-- ROW 1 - TITLE --}}
        <div class="row"> 
            <div class="col-md-12">
                <h1 class="page-head-line">@{{edit}} {{ rtrim($items,"s") }} {{ $item->title }}</h1>
            </div>
        </div>

        {{-- ROW 1 - TABLE--}}
        <div class="row">
            <div class="col-md-12">
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
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    @include("layouts.single-layout")
                                </tr>
                            </tbody>

                    </table>
                </div>
            </div>
        </div>


        <div v-if="show" class="row">
            <div class="col-md-8">
                <form class="" action="{{route("$items")}}" method="POST" class="">
                    @csrf
                        @if ($items == 'tasks')
                            <new-{{rtrim($items,'s')}}-part date="{{ date('Y-m-d H:i:s') }}" :clients="{{$clients}}" :users="{{$users}}" itemid="{{$item->id}}" :projects="{{$projects}}"/>
                        @elseif ($items == 'projects')
                            <new-{{rtrim($items,'s')}}-part date="{{ date('Y-m-d H:i:s') }}" :clients="{{$clients}}" :users="{{$users}}" itemid="{{$item->id}}" />
                        @elseif ($items == 'clients')
                            <new-{{rtrim($items,'s')}}-part date="{{ date('Y-m-d H:i:s') }}" itemid="{{$item->id}}" />
                        @endif
                </form>
            </div>
        </div>

    </div>
</div>

@endsection