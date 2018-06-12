@extends('layouts.app')
@section('title', '所有用户')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="well">
            <ol class="microblogs">
                @if($microblog->is_forward == 0)
                    @include('microblogs._singleMicroblog')
                @else
                    @include('microblogs._singleForwardedMicroblog',['initialUser' => $microblog->initialMicroblog->user,'initialMicroblog' =>$microblog->initialMicroblog,'user' => $microblog->user])
                @endif
            </ol>
        </div>
        <form action="{{ route('comments.store',$microblog->id) }}" method="POST">
            @include('common.error')
            {{ csrf_field() }}
            <textarea class="form-control" rows="3" placeholder="发表回复..." name="content">{{ old('content') }}</textarea>
            <button type="submit" class="btn btn-primary pull-right" style="margin-top:10px;">发布</button>
        </form>
        <div style="margin:100px 0px;">
            <h3 style="border-bottom:2px solid #f0f2f5 ">回复列表</h3>
               @include('comments_replies._showComments') 
        </div>    
    </div>    
@stop