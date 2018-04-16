@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Microblog / Show #{{ $microblog->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('microblogs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('microblogs.edit', $microblog->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Content</label>
<p>
	{{ $microblog->content }}
</p> <label>User_id</label>
<p>
	{{ $microblog->user_id }}
</p> <label>Category_id</label>
<p>
	{{ $microblog->category_id }}
</p> <label>Reply_count</label>
<p>
	{{ $microblog->reply_count }}
</p> <label>Like_count</label>
<p>
	{{ $microblog->like_count }}
</p> <label>View_count</label>
<p>
	{{ $microblog->view_count }}
</p> <label>Last_reply_user_id</label>
<p>
	{{ $microblog->last_reply_user_id }}
</p> <label>Order</label>
<p>
	{{ $microblog->order }}
</p> <label>Excerpt</label>
<p>
	{{ $microblog->excerpt }}
</p> <label>Slug</label>
<p>
	{{ $microblog->slug }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
