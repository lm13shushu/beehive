@extends('layouts.app')
@section('title','首页')

@section('searchType')
    <form action="{{ route('search.microblogs') }}"> 
        <div class="input-group" style="height: 48px;">
            <input type="text" class="form-control" name="query" placeholder="搜索微博..." style="height: 36px;margin-top:6px;">
            <span class="input-group-btn"><button class="btn btn-default" type="submit" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
        </div>
    </form>
@endsection

@section('content')
    @include('layouts._bodyPage')
    @if(Auth::check())
        <div class="row" style="margin: 0 auto;">
            <div class="col-md-8 panel panel-default"  style="background-color: #f5f5f5">
                <h3>微博列表</h3>
                @include('microblogs._feed')
            </div>
            <aside class="col-md-4" id="scrollDiv1"> 
                <div class = "col-md-11 col-md-offset-1 panel panel-default" style="background-color: #f5f5f5">
                    <section class="stats"> 
                        @include('users._userInfo', ['user' => Auth::user()])
                    </section>
                </div>
            </aside>
            @if (count($active_users))
                <aside class="col-md-4" id="scrollDiv2">
                    <div class = "col-md-11 col-md-offset-1 panel panel-default" style="background-color: #f5f5f5"> 
                        @include('users._active_users')
                    </div>
                </aside>
            @endif
        </div>
    @else
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class="jumbotron">
                        <h1>
                            Hello,beehive!
                        </h1>
                        <p>
                            这是一个微博类的社交应用,鼓励积极交流和发布动态。在这里你可以follow自己感兴趣的对象和内容、找寻属于自己的快乐>>>
                        </p>
                        <p>
                             <a class="btn btn-primary btn-large" href="#">了解更多</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
