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
            <form method="POST" action="{{route('timers.update', $timer)}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
            <input type="text" name="datetimes" class="datetimes-input">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
