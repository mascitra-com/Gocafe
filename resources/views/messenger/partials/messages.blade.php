@if(Auth::id() != $users[0]->id)
    <div class="contact-profile">
        <img src="{{url($cafeLogo)}}" alt=""/>
        <p>{{ $thread->subject }}</p>
    </div>
@else
    <div class="contact-profile">
        <img src="{{url($senderAvatar)}}" alt=""/>
        <p>{{ $thread->users[0]->owner->first_name }} {{ $thread->users[0]->owner->last_name }}</p>
    </div>
@endif
<div class="messages">
    <ul>
        @if(isset($thread->messages))
            @foreach($thread->messages as $message)
                @if($message->user_id != Auth::id())
                    <li class="sent">
                        <p>{{ $message->body }}</p>
                    </li>
                @else
                    <li class="replies">
                        <p>{{ $message->body }}</p>
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</div>