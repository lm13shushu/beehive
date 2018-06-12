@extends('layouts.app')
@section('searchType')
    <form action="{{ route('search.microblogs') }}"> 
        <div class="input-group" style="height: 48px;">
            <input type="text" class="form-control" name="query" placeholder="搜索微博..." style="height: 36px;margin-top:6px;">
            <span class="input-group-btn"><button class="btn btn-default" type="submit" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
        </div>
    </form>
@endsection

@section('content')
    @if($query)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default list-panel search-results">
                    <div class="panel-heading">
                        <h3 class="panel-title ">
                            <i class="fa fa-search"></i> 关于 “<span class="highlight">{{ $query }}</span>” 的搜索结果有{{ count($paginator['microblog'])."个"}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        @if($paginator['microblog'])
                            <div class="col-md-10 col-md-offset-1 search-microblog" style="border:2px dotted #f5f5f5">
                                <span>
                                    <h3 >
                                        你可能想找微博>>>
                                    </h3>
                                    <hr>
                                </span>
                                <div class="page" style="float:right;margin-top:-100px;">
                                    {{ $paginator['microblog']->render() }}  
                                </div>
                                @foreach($paginator['microblog'] as $microblog)
                                     @include('microblogs._microblogCard',[ 'user' => $microblog->user ])
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row text-center">
            <div class="col-md-12">
                <br>
                    <h2>你会搜索到什么？</h2>
                <br>
                <h4><<< search in beehive >>></h4>
            </div>
        </div>
    @endif
@endsection