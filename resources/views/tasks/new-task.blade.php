{{-- /Task v PHP --}}

{{-- <h3> Create new Task <i class="fas fa-pencil-alt prefix"></i> </h3>
<form action="{{route('tasks')}}" method="POST" class="">
    @csrf

    <div class="md-form amber-textarea active-amber-textarea-2">
        <new-task-part date="{{date('Y-m-d H:i:s')}}"/>
    </div>

    <div class="input-title">Assigned client</div>
    <select name="client_id" class="form-control">
        @foreach ($clients as $client)
            <option value="{{ $client->id}}">{{ $client->Company}} </option>
        @endforeach
    </select>
    
    <div class="input-title">Assigned user</div>
    <select name="user_id" class="form-control">
        @foreach ($users as $user)
            <option value="{{ $user->id}}">{{ $user->name}} </option>
        @endforeach
    </select>

    <div class="input-title">Assigned project</div>
    <select name="project_id" class="form-control">
        @foreach ($projects as $project)
            <option value="{{$project->id}}">{{ $project->title}} </option>
        @endforeach
    </select><br>

    <button type="send" class="btn btn-warning">Send</button>
</form> --}}