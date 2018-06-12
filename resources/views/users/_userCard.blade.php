<div class = "col-md-8 col-md-offset-2 panel panel-default" style="background-color: #ffffff;padding: 0;">
    <div class = "col-md-6" style="margin: 0">
        <div align="center" style="margin:20px 0px;border-right: 1px dotted #f5f5f5">
            <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="100px" height="100px">
             <span>
                <a href="{{ route('users.show', $user->id) }}" class="username userId" value="{{ $user->id }}">
                    <h4>{{ $user->name }}</h4>
                </a>
            </span>
        </div>
    </div>
    <div class = "col-md-6" style="margin-top:20px;">
        <span>
            <h5>粉丝:&nbsp;&nbsp;<span class="badge">{{ count($user->followings) }}</span></h5>
            <h5>关注:&nbsp;&nbsp;<span class="badge">{{ count($user->followers) }}</span></h5>
            <h5>创建时间:{{ $user->created_at->diffForHumans() }}</h5>
            <h5><span class="glyphicon glyphicon-envelope"></span>&nbsp;{{ $user->email }}</h5>
            <h5><span class="glyphicon glyphicon-tag"></span>&nbsp;{{ $user->introduction }}</h5>
        </span>
    </div>
</div>