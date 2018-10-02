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
            <a href="{{route('projects.index')}}" class="btn btn-primary">Projektu administravimas</a>
            <form method="POST" action="{{route('showTimer')}}">
                {{ csrf_field() }}

                    <select class="task_select" name="task_id">
                        <option selected disabled></option>
                        @foreach ($taskSelect as $select)
                            <option value="{{$select->id}}">
                                <span>{{$select->title}}</span><span> @if($select->project_id !=null)-({{$select->project->title}})@endif</span>
                            </option>
                        @endforeach
                    </select>

                    <select class="project_select" name="project_id">
                        <option selected disabled></option>
                        @foreach ($projects as $project)
                            <option value="{{$project->id}}">{{$project->title}}</option>
                        @endforeach
                    </select>
                <a href="{{ route('timers.create') }}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-time"></span></a>
                <button type="submit" id="start" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-play"></span></button>
            </form>
        </div>
        <div class="col-xs-9">
        <table class="table table-hover">
            <thead>
            @foreach($tasks as $task)
            <tr>
                <th scope="col"><a href="{{route('tasks.edit', $task)}}" style="text-decoration: none;">{{$task->title}}</a>
                        <span class="project-title">@if($task->project_id !=null)-({{$task->project->title}})@endif</span>
                    </th>
                <th scope="col"></th>
                <th scope="col">Viso:<span class="humanize">{{$task->timer->sum('total_time')}}</span></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($task->timer as $timer)
            <tr class="title">
                <th scope="row"></th>
                <td>{{$timer->started_at}} - {{$timer->stopped_at}}</td>
                <td class="humanize">{{$timer->total_time}}</td>
                <td>
                    <div class="row delete">
                    <a href="{{ route('timers.edit', $timer) }}" class="btn btn-default btn-link"><span class="glyphicon glyphicon-pencil"></span></a>
                    <form action="{{ route('timers.destroy', $timer) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-link"><span class="glyphicon glyphicon-trash text-danger"></span></button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
            @endforeach
        </table>
            {{ $tasks->links() }}
        </div>
    </div>



@endsection
