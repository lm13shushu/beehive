@extends('layouts.app')
@section('title', '请选择关注的用户')

@section('content')
    <div class = "col-md-10 col-md-offset-1 panel panel-default" style="background-color: #ffffff;padding: 0;border: 5px dotted #f5f5f5"> 
        <h3>以下是当前活跃用户，请选择关注>>></h3>      
        @foreach($active_users as $user)
            @include('users._userCard')
        @endforeach
    </div>
@stop