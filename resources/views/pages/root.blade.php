@extends('layouts.app')
@section('title','首页')

@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-md-8 well well-lg" >
                <h3>微博列表</h3>
                @include('microblogs._feed')
            </div>
            <aside class="col-md-4"> 
                <div class = "col-md-10 col-md-offset-1 well">
                    <section class="stats">
                        @include('users._userInfo', ['user' => Auth::user()])
                    </section>
                </div>
            </aside>
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

