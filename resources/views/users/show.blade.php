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
                        <h5><a href="#"><span class="glyphicon glyphicon-user"></span></a>&nbsp;{{ $user->name }}</h5>
                        <h5><a href="#"><span class="glyphicon glyphicon-tag"></span></a>&nbsp;{{ $user->introduction }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix" style="margin-top:20px;">
            <div class="col-md-2 column">
                <div class="list-group">
                     <a href="#" class="list-group-item active">操作</a>
                    <div class="list-group-item">
                        我的微博
                    </div>
                    <div class="list-group-item">
                            回复
                    </div>
                    <div class="list-group-item">
                         <span class="badge">14</span> Help
                    </div>
                </div>
            </div>

            <!-- 左部具体信息展示 -->
            <div class="col-md-10 column" style="border:1px solid black;">
                <div class="row clearfix">
                    <div class="col-md-12 column">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop