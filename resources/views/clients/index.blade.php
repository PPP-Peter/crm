{{-- 
     Nastav v controlleri podla modelu
        - collection ( collection ) 
        - items ( string )
        - table ( field of strings ) podla toho ake dáta chces vytiahnuť
 --}}

 {{-- @foreach ($open_projects[3]['projects'] as $item)
     {{ $item['status'] }}
 @endforeach --}}
  {{-- {{ $open_projects[3]['projects'] }} --}}

 {{-- @foreach ($open_projects as $open_project) --}}
 {{-- <li>{{$open_project}}</li> --}}
 {{-- <li>{{ var_dump($open_project->status)}}</li> --}}
 {{-- @endforeach --}}

@include( "layouts.index-layout") 

