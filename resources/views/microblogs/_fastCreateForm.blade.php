<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @include('common.error')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">创建新的微博</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('microblogs.store') }}">
                    {{ csrf_field() }}
                    <select class="form-control" name="category_id" required>
                        <option value="">请选择#话题#</option>
                        @foreach ($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <textarea id="fastC_post_body" name="content" class="textarea" placeholder="写一篇新微博..."></textarea>
                    <button type="submit" class="btn btn-primary">
                    发布
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </form>      
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
