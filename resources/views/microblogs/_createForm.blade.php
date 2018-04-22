  <form class="form-horizontal" method="POST" action="{{ route('microblogs.store') }}">
    {{ csrf_field() }}
    @include('common.error')
    <select class="form-control" name="category_id" required>
        <option value="">请选择#话题#</option>
        @foreach ($categories as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
    <textarea id="post_body" name="content" class="textarea" placeholder="发一篇新微博..."></textarea>
    <button type="submit" class="btn btn-primary">
            发布
    </button>
</form>

@section('scripts')
    <script type="text/javascript">
        $("#post_body").qeditor({});
    </script>
@stop