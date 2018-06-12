@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <h3>#{{ $category }}#话题下的微博</h3>
        <div class="microblogInCategory" style="border: 5px dotted #f5f5f5;">
             @include('microblogs._microblog')
        </div>
    </div>  
@stop