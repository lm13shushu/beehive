@if (count($microblogs) > 0)
    <ol class="microblogs">
        @foreach ($microblogs as $microblog)
            @include('microblogs._singleMicroblog')
        @endforeach
    </ol>
     {!! $microblogs->render() !!}
@endif



