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
                                    <span class="contact-status online"></span>
                                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                    <div class="meta">
                                        <p class="name">{{ $list->subject }}</p>
                                        <p class="preview">New Message</p>
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
            @else
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
        // $(".messages").animate({ scrollTop: $(document).height() }, "fast");
        //
        // function newMessage() {
        //     message = $(".message-input input").val();
        //     if($.trim(message) == '') {
        //         return false;
        //     }
        //     $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
        //     $('.message-input input').val(null);
        //     $('.contact.active .preview').html('<span>You: </span>' + message);
        //     $(".messages").animate({ scrollTop: $(document).height() }, "fast");
        // };
        //
        // $('.submit').click(function() {
        //     newMessage();
        // });
        //
        // $(window).on('keydown', function(e) {
        //     if (e.which == 13) {
        //         newMessage();
        //         return false;
        //     }
        // });
        //# sourceURL=pen.js
        $(".contact").click(function() {
            window.location = $(this).find("a").attr("href");
            return false;
        });
    </script>
@endsection