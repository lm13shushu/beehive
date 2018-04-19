@extends('layouts.app')

@section('title',$user->name . '的个人中心')

@section('content')
    <div class="container">
      <!-- 顶部用户信息展示 -->
        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="jumbotron user-info">
                    <div class="user-info-avatar">
                        <img src="{{ $user->avatar }}" class="img-circle" width="62px" height="62px">
                    </div>
                    <div class="user-email">
                        <h3>{{ $user->email }}</h3>
                    </div>
                    <div class="user-follow-status">
                        <h5><a href="#">正在关注<span class="badge">21</span></a>&nbsp;|&nbsp;<a href="#">关注者<span class="badge">500</span></a></h5>
                    </div>
                    <div class="user-follow">
                        <div class="user-follow-form">
                            <button type="submit" class="btn btn-sm btn-primary">关注</button>
                        </div>
                    </div>
                    <div class="user-name-description">
                        <h5><a href="#"><span class="glyphicon glyphicon-user" value="{{ $user->id }}"></span></a>&nbsp;{{ $user->name }}</h5>
                        <h5><a href="#"><span class="glyphicon glyphicon-tag"></span></a>&nbsp;{{ $user->introduction }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- 左部信息展示 --}}
        <div class="row clearfix" style="margin-top:20px;margin-right:0px;">
                <div class="col-md-2 column">
                    <div class="btn-group-vertical col-md-12" style="margin: 0;padding: 0;">
                        <button type="button" class="btn btn-default createForm">新微博</button>
                        <button type="button" class="btn btn-default show-person-microblogs">我的微博</button>
                    </div>
                </div>

            <!-- 右部具体信息展示 -->
             <div class="col-md-10 column"  style="border-left:1px solid #f5f5f5;">
                <div class="row clearfix">
                    <div class="col-md-12" id="show-person-info">
                        @include('microblogs._createForm')
                    </div>
                </div>
             </div>
        </div>
    </div>
@stop