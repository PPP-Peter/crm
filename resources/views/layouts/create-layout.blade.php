
@extends('layouts.header')


@section('content')

@include('errors')
 
    <div id="page-wrapper">
        <div id="page-inner">

            <div class="row justify-content-center">
                <div class="col-md-8">

                    <h3> Create new {{ $item }} <i class="fas fa-pencil-alt prefix"></i> </h3>
                    <form  action="{{route("$item"."s")}}" method="POST" class="createform">
                        @csrf
                    
                        <div class="md-form amber-textarea active-amber-textarea-2">

                            @if ($item == 'task')
                                <new-task-part date="{{date('Y-m-d H:i:s')}}" :clients="{{$clients}}" :users="{{$users}}"  :projects="{{$projects}}"/>
                            @elseif ($item == 'project')
                                <new-project-part date="{{date('Y-m-d H:i:s')}}" :clients="{{$clients}}" :users="{{$users}}"/>
                            @elseif ($item == 'client')
                                <new-{{ $item }}-part date="{{ date('Y-m-d H:i:s') }}" />
                            @endif
                            
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

