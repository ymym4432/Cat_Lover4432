<ul class="list-unstyled">
    @foreach ($cat_lovers as $cat_lover)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($cat_lover->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $cat_lover->user->name, ['id' => $->user->id]) !!} <span class="text-muted">posted at {{ $cat_lover->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($cat_lover->content)) !!}</p>
                </div>
            </div>
                @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $cat_lovers->links('pagination::bootstrap-4') }}