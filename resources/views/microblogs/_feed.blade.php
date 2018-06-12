@if (count($feed_items))
    <ol class="microblogs">
        @foreach ($feed_items as $microblog)
            @if($microblog->is_forward == 0)
                @include('microblogs._singleMicroblog', ['user' => $microblog->user])
            @else
                @include('microblogs._singleForwardedMicroblog',['user' => $microblog->user])
            @endif
        @endforeach
     {!! $feed_items->render() !!}
    </ol>
    @include('microblogs._showForwardInterface')
@endif