@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-xs-9">
            <a href="{{ route('tasks.index') }}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-menu-left"></span>
            <a href="{{ route('projects.create') }}" class="btn btn-default btn-lg float-right"><span class="glyphicon glyphicon-plus text-success">Add</span></a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Project title</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Update/Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                 <tr>
                    <td>{{$project->title}}</td>
                    <td>{{$project->created_at}}</td>
                    <td>{{$project->updated_at}}</td>
                    <td>
                        <div class="row">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-default btn-link"><span class="glyphicon glyphicon-pencil"></span></a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-link"><span class="glyphicon glyphicon-trash text-danger"></span></button>
                        </form>
                        </div>
                    </td>
                 </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
