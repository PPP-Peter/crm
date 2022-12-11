@foreach ($table as $key=>$table_item)

       @if ($key == 5 && isset($item->user->name))       {{-- for users --}}
            <td data-typeId="{{$item->$table_item}}">{{$item->user->name}} </td>

        @elseif ($key == 6 && isset($item->client->Company))   {{-- for clients --}}
             <td  data-typeId="{{$item->$table_item}}"> <a href="{{ route('clients') }}/{{$item->id}}">{{$item->client->Company}}</a> </td> 

        @elseif ($key == 7 && isset($item->project->title) )   {{-- for projects --}}
            <td data-typeId="{{$item->$table_item}}"> <a href="{{ route('projects') }}/{{$item->id}}"> {{$item->project->title}}</a> </td>
            
        @elseif ($item->$table_item)
            <td class="tdtext" class="table-max" value="{{$item->$table_item}}">{{ $item->$table_item, 10 }}</td>

        @else 
             <td>deleted</td>

        @endif
                                                                                  
@endforeach


