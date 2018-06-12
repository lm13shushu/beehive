<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('microblogs.store') }}">
    {{ csrf_field() }}
    @include('common.error')
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"  style="height:35px;" >@
        </button>
        <ul class="dropdown-menu" role="menu">
            @foreach($ats as $at)
                <li value="{{ $at }}" onclick="at(this)">
                    {{ $at }}
                </li>
            @endforeach
        </ul>
        <input type="text" id="atInput" name="at_user" style="width:915px;height:35px;" placeholder="点击右边 '@' 按钮选择你要 '@' 的人">
    </div>

    <select class="form-control" name="category_id" required style="height:40px">
        <option value="">请选择 #话题#</option>
        @foreach ($categories as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
    <textarea id="post_body" name="content" class="textarea"  placeholder="发一篇新微博..."></textarea>
    <button type="submit" class="btn btn-primary" style="float: right;">
            发布
    </button>
</form>

@section('scripts')
    <script type="text/javascript">
        $("#post_body").qeditor({});
    </script>   
@stop
