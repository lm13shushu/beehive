<form action="{{ route('microblogs.store') }}" method="POST">
    @include('common.error')
    {{ csrf_field() }}
    <textarea class="form-control" rows="3" placeholder="聊聊新鲜事儿..." name="content">{{ old('content') }}</textarea>
    <button type="submit" class="btn btn-primary pull-right" style="margin-top:10px;">发布</button>
</form>