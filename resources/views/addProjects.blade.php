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
                <form action="{{ route('projects.store') }}" method="post">
                    <legend>Add new project</legend>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">PRoject Title</label>
                        <input type="text" class="form-control @if ($errors->has('title')) alert-danger @endif" name="title">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>

    </div>
@endsection
