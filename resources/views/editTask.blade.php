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
        <div class="row">
            <div class="col-xs-4">
                <form action="{{ route('tasks.update', $task) }}" method="post">
                    <legend>Update task</legend>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <input type="text" class="form-control @if ($errors->has('title')) alert-danger @endif" name="title" id="" value="{{ $task->title }}">
                    </div>
                    <div class="form-group">
                        <select class="project_select" name="project_id">
                            <option selected disabled></option>
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
            </div>
        </div>

    </div>
@endsection
