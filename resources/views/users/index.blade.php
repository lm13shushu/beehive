@extends('layouts.app')
@section('title', '所有用户')

@section('searchType')
    <form action="{{ route('search.users') }}"> 
        <div class="input-group" style="height: 48px;">
            <input type="text" class="form-control" name="query" placeholder="搜索用户..." style="height: 36px;margin-top:6px;">
            <span class="input-group-btn"><button class="btn btn-default" type="submit" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
        </div>
    </form>
@endsection

@section('content')
    <div class="col-md-offset-1 col-md-10" style="border: 5px dotted #f5f5f5">
        <h1>所有用户</h1>
        <div class="page" style="float: right;margin-top:-80px;">
            {!! $users->render() !!}
        </div>
        <hr>
            <ul class="users">
                @foreach ($users as $user)
                    @include('users._userCard')
                @endforeach
            </ul>
    </div>    
@stop