@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Microblog
                    <a class="btn btn-success pull-right" href="{{ route('microblogs.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($microblogs->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Content</th> <th>User_id</th> <th>Category_id</th> <th>Reply_count</th> <th>Like_count</th> <th>View_count</th> <th>Last_reply_user_id</th> <th>Order</th> <th>Excerpt</th> <th>Slug</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($microblogs as $microblog)
                                <tr>
                                    <td class="text-center"><strong>{{$microblog->id}}</strong></td>

                                    <td>{{$microblog->content}}</td> <td>{{$microblog->user_id}}</td> <td>{{$microblog->category_id}}</td> <td>{{$microblog->reply_count}}</td> <td>{{$microblog->like_count}}</td> <td>{{$microblog->view_count}}</td> <td>{{$microblog->last_reply_user_id}}</td> <td>{{$microblog->order}}</td> <td>{{$microblog->excerpt}}</td> <td>{{$microblog->slug}}</td>
                                    
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('microblogs.show', $microblog->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a>
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('microblogs.edit', $microblog->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('microblogs.destroy', $microblog->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $microblogs->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection