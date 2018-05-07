@if (count($microblogs) > 0)
    <ol class="microblogs">
        @foreach ($microblogs as $microblog)
            @include('microblogs._singleMicroblog')
        @endforeach
    </ol>
     {!! $microblogs->render() !!}
     @else
     <h3>暂无微博，赶快去发一个吧！</h3>
@endif



