@extends('layouts.app')
@section('title', '微博不存在')

@section('content')

<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="alert alert-danger text-center">
                该微博已经被删除！
            </div>
            <a class="btn btn-lg btn-primary btn-block" href="{{ route('home') }}">
                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                返回首页
            </a>
        </div>
    </div>
</div>

@stop