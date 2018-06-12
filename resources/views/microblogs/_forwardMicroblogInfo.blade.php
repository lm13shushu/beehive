 @include('microblogs._singleForwardingMicroblog')
 <form action="{{ route('microblogs.forward',$microblog->id) }}" method="POST">
     {{ csrf_field() }}
    <textarea  name="forward_content" class="textarea" placeholder="转发内容..." style="width:570px;margin-top:10px;"></textarea>
    <button type="submit" class="btn btn-primary">转发</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</form>
