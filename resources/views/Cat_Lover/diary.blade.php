<ul class="list-unstyled">
    @foreach ($diaries as $diary)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($diary->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $diary->user->name, ['id' => $->user->id]) !!} <span class="text-muted">posted at {{ $cat_lover->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($diary->content)) !!}</p>
                </div>
            </div>
                @if (Auth::id() == $diary->user_id)
                        {!! Form::open(['route' => ['diaries().destroy', $diary->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $diary->links('pagination::bootstrap-4') }}