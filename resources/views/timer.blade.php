@extends('layouts.app')

@section('content')

    @foreach($timers as $timer)
            <div class="container border main-wrapper">
                <div class="row border w-75 h-75 timer-row">
                    <div class="col-sm timer-div">
                        <div class="row">
                            <div id="timer"></div><span id="timer-title"> prie {{$timer->task->title}}</span>
                        </div>
                    </div>
                    <div class="col-sm timer-div">
                    </div>
                    <div class="col-sm timer-div">
                        <a href="{{ route('stopTimer', $timer->id) }}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-stop"></span></a>
                    </div>
                </div>
            </div>
    @endforeach
<script>
    var _wasPageCleanedUp = false;
    function pageCleanup()
    {
        if (!_wasPageCleanedUp)
        {
            $.ajax({
                type: 'GET',
                async: false,
                url: 'http://tracking.test/public/stopTimer/{{$timer->id}}',
                success: function ()
                {
                    _wasPageCleanedUp = true;
                }
            });
        }
    }
    $(window).on('beforeunload', function ()
    {
        pageCleanup();
    });

    $(window).on("unload", function ()
    {
        pageCleanup();
    });
</script>
@endsection
