@extends('_layout/dashboard/index')
@section('page_title', 'Percakapan')

@section('content')
    @include('messenger.partials.flash')
    <div id="frame">
        <div id="sidepanel">
            <div id="contacts">
                <ul>
                    @if(isset($threads))
                        @foreach($threads as $list)
                            <li class="contact">
                                <a href="{{ url('messages/'.$list->id) }}"></a>
                                <div class="wrap">
                                    <img src="{{ Auth::id() != $list->users[0]->id ? $list->senderAvatar : $list->recipientAvatar}}" alt="" />
                                    <div class="meta">
                                        <p class="name">
                                            {{ Auth::id() != $list->users[0]->id
                                            ? $list->subject
                                            : $list->users[1]->owner->first_name .' '. $list->users[1]->owner->last_name }}
                                        </p>
                                        <p class="preview">{{ $list->latestMessage->body }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="content">
            @if(isset($thread))
                @include('messenger.partials.messages')
                <form class="message-input" method="post" action="{{ url('messages/'.$thread->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="recipient" value="{{ isset($recipient) ? $recipient->id : ''}}">
                    <div class="wrap">
                        <input type="text" placeholder="Write your message..." name="message" />
                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </form>
            @elseif(isset($cafe))
            <form class="message-input" method="post" action="{{ url('messages') }}">
                {{ csrf_field() }}
                <input type="hidden" name="subject" value="{{ isset($cafe) ? $cafe->name : ''}}">
                <input type="hidden" name="recipient" value="{{ isset($recipient) ? $recipient->id : ''}}">
                <div class="wrap">
                    <input type="text" placeholder="Write your message..." name="message" />
                    <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </form>
            @endif
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
@endsection

@section('javascripts')
    <script >
        $(".contact").click(function() {
            window.location = $(this).find("a").attr("href");
            return false;
        });
    </script>
@endsection