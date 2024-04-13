<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
<section class="msger">
    <header class="msger-header">
        <div class="msger-header-title">
            <i class="fas fa-comment-alt"></i> Chatting with {{$receiver->name}}
        </div>
        <div class="msger-header-options">
            <span><i class="fas fa-cog"></i></span>
        </div>
    </header>

    <main class="msger-chat">
        @foreach($messages as $message)
            @if($message->sender_id == $sender->id)
                <div class="msg right-msg">
                    @else
                        <div class="msg left-msg">
                            @endif
                            <div class="msg-img" style="background-image: url({{ $message->sender_id == $sender->id ? asset('path/to/sender/image') : asset('path/to/receiver/image') }})"></div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ $message->sender_id == $sender->id ? $sender->name : $receiver->name }}</div>
                                    <div class="msg-info-time">{{ $message->created_at->format('H:i') }}</div>
                                </div>
                                <div class="msg-text">
                                    {{ $message->message_content }}
                                </div>
                            </div>
                        </div>
                @endforeach
    </main>

    <form class="msger-inputarea" method="post" action="{{ route('sendMessage', ['receiver_id' => $receiver->id]) }}">
        @csrf
        <input type="text" class="msger-input" name="message" placeholder="Enter your message...">
        <button type="submit" class="msger-send-btn">Send</button>
    </form>
</section>
</body>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    const pusher = new Pusher('8cfdd2443899a0acb693', {
        cluster: 'ap2'
    });

    const channel = pusher.subscribe('chat');
    const senderId = {{$sender->id}};

    channel.bind('chat-event', function(data) {
        const isSender = data.sender_id === senderId;
        const msgClass = isSender ? 'right-msg' : 'left-msg';
        const imgURL = isSender ? '{{ asset('path/to/sender/image') }}' : '{{ asset('path/to/receiver/image') }}';
        const senderName = isSender ? '{{$sender->name}}' : '{{$receiver->name}}';

        // Extract the time portion from the created_at timestamp
        const messageTime = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });

        const newMessageHtml = `
            <div class="msg ${msgClass}">
                <div class="msg-img" style="background-image: url(${imgURL})"></div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">${senderName}</div>
                        <div class="msg-info-time">${messageTime}</div>
                    </div>
                    <div class="msg-text">
                        ${data.message_content}
                    </div>
                </div>
            </div>
        `;

        const chatWindow = document.querySelector('.msger-chat');
        chatWindow.insertAdjacentHTML('beforeend', newMessageHtml);

        // Scroll to the bottom after adding the new message
        chatWindow.scrollTo({
            top: chatWindow.scrollHeight,
            behavior: 'smooth'
        });
    });

    window.addEventListener('load', function() {
        const chatWindow = document.querySelector('.msger-chat');
        chatWindow.scrollTop = chatWindow.scrollHeight;
    });

    document.querySelector('.msger-chat').style.scrollBehavior = 'smooth';
</script>





{{--<script>--}}
{{--    // Enable pusher logging - don't include this in production--}}
{{--    Pusher.logToConsole = true;--}}

{{--    const pusher = new Pusher('8cfdd2443899a0acb693', {--}}
{{--        cluster: 'ap2'--}}
{{--    });--}}

{{--    const channel = pusher.subscribe('chat');--}}
{{--    const senderId = {{$sender->id}};--}}

{{--    channel.bind('chat-event', function(data) {--}}
{{--        const isSender = data.sender_id === senderId;--}}
{{--        const msgClass = isSender ? 'right-msg' : 'left-msg';--}}
{{--        const imgURL = isSender ? '{{ asset('path/to/sender/image') }}' : '{{ asset('path/to/receiver/image') }}';--}}
{{--        const senderName = isSender ? '{{$sender->name}}' : '{{$receiver->name}}';--}}

{{--        // Extract the time portion from the created_at timestamp--}}
{{--        const messageTime = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });--}}

{{--        const newMessageHtml = `--}}
{{--            <div class="msg ${msgClass}">--}}
{{--                <div class="msg-img" style="background-image: url(${imgURL})"></div>--}}
{{--                <div class="msg-bubble">--}}
{{--                    <div class="msg-info">--}}
{{--                        <div class="msg-info-name">${senderName}</div>--}}
{{--                        <div class="msg-info-time">${messageTime}</div>--}}
{{--                    </div>--}}
{{--                    <div class="msg-text">--}}
{{--                        ${data.message_content}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        `;--}}

{{--        document.querySelector('.msger-chat').insertAdjacentHTML('beforeend', newMessageHtml);--}}
{{--    });--}}

{{--    // Handle form submission to prevent default behavior--}}
{{--    document.getElementById('sendMessageForm').addEventListener('submit', function(event) {--}}
{{--        event.preventDefault(); // Prevent default form submission--}}

{{--        const formData = new FormData(this); // Get form data--}}
{{--        const url = this.getAttribute('action'); // Get form action URL--}}

{{--        // Send AJAX request to submit the form data--}}
{{--        fetch(url, {--}}
{{--            method: 'POST',--}}
{{--            body: formData--}}
{{--        })--}}
{{--            .then(response => response.json())--}}
{{--            .then(data => {--}}
{{--                // Handle success response if needed--}}
{{--                console.log(data);--}}
{{--                // Clear the message input field if needed--}}
{{--                document.querySelector('.msger-input').value = '';--}}
{{--            })--}}
{{--            .catch(error => {--}}
{{--                // Handle error if needed--}}
{{--                console.error('Error:', error);--}}
{{--            });--}}
{{--    });--}}
{{--</script>--}}






</html>
