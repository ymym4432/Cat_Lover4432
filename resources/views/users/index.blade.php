@endif
    
    {{ $messages->links('pagination::bootstrap-4') }}
    
    {!! link_to_route('messages.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection