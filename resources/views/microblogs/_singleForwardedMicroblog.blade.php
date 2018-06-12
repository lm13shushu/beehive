<li id="microblogs-{{ $microblog->id }}">
    <div>
        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-circle" width="45px" height="45px" style="margin-top:10px;" />
       <a href="{{ route('users.show', $user->id ) }}">{{ $user->name }}</a>&nbsp;{{ $microblog->created_at->diffForHumans() }}&nbsp;转发了微博>>>
    </div> 
    {{-- 删除 --}}
    @can('destroy', $microblog)
        <form action="{{ route('microblogs.destroy', $microblog->id) }}" method="POST" style="float:right;position: relative; margin-top:-50px;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
        </form>
    @endcan

    @if($microblog->initialMicroblog)
        @include('microblogs._singleForwardedMicroblogInfo',['initialUser' => $microblog->initialMicroblog->user,'initialMicroblog' =>$microblog->initialMicroblog])
        @else
        <div class="forwordedMicroblog-del" style="margin-left:50px;margin-top:-10px;padding: 10px;background-color: #E6E6FA;border-radius:10px;">
            <h4>该转发内容已经被删除</h4>
        </div>
    @endif
</li>