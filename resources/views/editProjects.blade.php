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
                <form action="{{ route('projects.update', $project) }}" method="post">
                    <legend>Update project</legend>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <input type="text" class="form-control @if ($errors->has('title')) alert-danger @endif" name="title" id="" value="{{ $project->title }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
@endsection
