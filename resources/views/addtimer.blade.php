@extends('layouts.app')

@section('content')

    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-xs-9">
            <form method="POST" action="{{route('timers.store')}}">
                {{ csrf_field() }}

                    <select class="task_select" name="task_id">
                        <option selected disabled></option>
                        @foreach ($tasks as $task)
                            <option value="{{$task->id}}">{{$task->title}} @if($task->project_id !=null){{$task->project->title}}@endif</option>
                        @endforeach
                    </select>

                    <select class="project_select" name="project_id">
                        <option selected disabled></option>
                        @foreach ($projects as $project)
                            <option value="{{$project->id}}">{{$project->title}}</option>
                        @endforeach
                    </select>
                    <input type="text" name="datetimes" class="datetimes-input">
                <button type="submit" class="btn btn-default btn-lg" name="submit"><span class="glyphicon glyphicon-plus"></span></button>
                <a href="{{ route('tasks.index') }}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-remove text-danger"></span></a>
            </form>
        </div>
    </div>
@endsection
