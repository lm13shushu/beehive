@extends('layouts.app')

@section('title',$user->name . '的个人中心')

@section('content')
    <div class="container">
      <!-- 顶部用户信息展示 -->
        <div class="row clearfix">
            <div class="col-md-12 column">
                @include('layouts._message')
                @include('common.error')
                <div class="jumbotron user-info">
                    <div class="user-info-avatar">
                        <img src="{{ $user->avatar }}" class="img-circle" width="62px" height="62px">
                    </div>
                    <div class="user-email">
                        <h3>{{ $user->email }}</h3>
                    </div>
                    <div class="user-follow-status">
                        <h5><a href="{{ route('users.followings',$user->id) }}">正在关注<span class="badge">{{ count($user->followings) }}</span></a>&nbsp;|&nbsp;<a href="{{ route('users.followers',$user->id) }}">粉丝<span class="badge">{{ count($user->followers) }}</span></a>
                        </h5>
                    </div>
                    <div class="user-follow">
                        <div class="user-follow-form" id="user-follow-form">
                            @if(Auth::check())
                                @include('users._follow_form')
                            @endif
                        </div>
                    </div>
                    <div class="user-name-description">
                        <h5><a href="#"><span class="glyphicon glyphicon-user userId" value="{{ $user->id }}"></span></a>&nbsp;{{ $user->name }}</h5>
                        <h5><a href="#"><span class="glyphicon glyphicon-tag"></span></a>&nbsp;{{ $user->introduction }}</h5>
                        <h6>注册于:{{ $user->created_at->diffForHumans() }}&nbsp;&nbsp;&nbsp;&nbsp;
                            最后活跃:{{ $user->last_actived_at->diffForHumans() }}</h6>
                    </div>
                </div>
            </div>
        </div>

        {{-- 左部信息展示 --}}
        <div class="row clearfix" style="margin-top:20px;margin-right:0px;">
            <div class="col-md-2 column" >
                <div  style="margin: 0;padding: 0;">
                    <button type="button" class="btn btn-default btn-block show-person-microblogs {{ active_class(if_route('microblogs.showPerson')) }}">已发微博</button>
                    @can('showCreate', $user)
                        <button type="button" class="btn btn-default btn-block createForm {{ active_class(if_route('microblogs.create')) }}">新微博</button>
                    @endcan
                </div>
            </div>

            <!-- 右部具体信息展示 -->
             <div class="col-md-10 column"  style="border-left:1px solid #f5f5f5;">
                <div class="row clearfix">
                    <div class="col-md-12" id="show-person-info">
                        @include('microblogs._microblog')
                    </div>
                </div>
             </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        function at(e){
            var atUserName= e.getAttribute("value");
            var atUser ="@"+atUserName+";";
            document.getElementById('atInput').value +=atUser;
        }
    </script>   
@stop

