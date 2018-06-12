@if (count($microblogs) > 0)
    <ol class="microblogs">
        @foreach ($microblogs as $microblog)
            @if($microblog->is_forward == 0)
                @include('microblogs._singleMicroblog', ['user' => $microblog->user])
            @else
                @include('microblogs._singleForwardedMicroblog',['user' => $microblog->user])
            @endif
        @endforeach
    </ol>
    @include('microblogs._showForwardInterface')
     {!! $microblogs->render() !!}
     @else
     <h3>暂无微博，赶快去发一个吧！</h3>
@endif

    

