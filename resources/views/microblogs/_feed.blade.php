@if (count($feed_items))
    <ol class="microblogs">
        @foreach ($feed_items as $microblog)
            @include('microblogs._singleMicroblog', ['user' => $microblog->user])
        @endforeach
     {!! $feed_items->render() !!}
    </ol>
@endif