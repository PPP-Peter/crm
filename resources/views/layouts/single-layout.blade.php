@foreach ($table as $key=>$table_item)

        @if ($key == 5)
            <td data-typeId="{{$item->$table_item}}">{{$item->user->name}} </td>
        @elseif ($key == 6 )
            @if (isset($item->client->Company))
                <td  data-typeId="{{$item->$table_item}}"> {{$item->client->Company}}</td>
            @else 
                <td>deleted</td>
            @endif
        

        @elseif ($key == 7 && isset($item->project->title) )
            @if (isset($item->project->title))
                <td data-typeId="{{$item->$table_item}}"> {{$item->project->title}}</td>
            @else 
                <td>deleted</td>
            @endif
            {{-- {{ $clients->where('id', 10)[1]->Company }} --}}
        @else 


            @if ( strtotime($item->$table_item) !== false ) 
                <td class="tdtext" style="max-width:400px" value="{{$item->$table_item}}" data-typeId="{{$item->$table_item}}">{{ date('d-m-Y', strtotime($item->$table_item)) }}</td>
            @else
                <td class="tdtext" style="max-width:400px" value="{{$item->$table_item}}">{{ $item->$table_item }}</td>
           @endif

        @endif
                                                                                  
@endforeach
