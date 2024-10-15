<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 80px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .chat-card {
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            width: calc(33.33% - 20px); /* Width for three cards in a row */
        }

        .chat-card:hover {
            transform: scale(1.02);
        }

        .chat-card-header {
            background-color: orange;
            color: white;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .chat-info {
            font-weight: bold;
            padding: 10px;
        }

        .chat-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }

        .chat-button:hover {
            background-color: #218838;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .go-back-button {
            background-color: orange;
            border-radius: 50px;
            margin-top: 20px;
            padding: 10px;
            margin-bottom: 20px;
            color: #ffff;
            text-decoration: none;
        }
        .go-back-button:hover {
            background-color: #fff;
            border: 2px solid orange;
            color: orange;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .chat-card {
                width: calc(50% - 20px); /* Two cards in a row on smaller screens */
            }
        }

        @media (max-width: 576px) {
            .chat-card {
                width: 100%; /* Single card in a row on extra small screens */
            }
        }
    </style>
</head>
<body>
    <!-- Go Back Button -->
    <div class="container">
        {{-- <a href="{{ route('home', ['user_id' => $user->id]) }}" class="go-back-button">
            Go Back
        </a> --}}
        <a href="{{ url()->previous() }}" class="go-back-button">
            Go Back
        </a>
    </div>

    <div class="container">
        <!-- Search Bar -->
        <input type="text" id="search-bar" class="form-control search-bar" placeholder="Search...">

        <!-- Chats List -->
        <div id="chats-list" class="d-flex flex-wrap justify-content-start">
            @foreach ($chats as $chat)
                <div class="card chat-card">
                    <div class="card-header chat-card-header">
                        Chat with {{ isset($chat->buyer_name) ? $chat->buyer_name : $chat->seller_name }}
                    </div>
                    <div class="card-body">
                        <div class="chat-info">
                            @if(isset($chat->buyer_name))
                                <small>{{ $chat->buyer_email }}</small><br>
                                <small>Store: {{ $chat->store_name }}</small>
                            @else
                                <small>Store: {{ $chat->store_name }}</small>
                            @endif
                        </div>
                        <div class="mt-2">
                            @if(isset($chat->buyer_id))
                                <a href="{{ route('chat_form', $chat->buyer_id) }}" class="chat-button">Chat Now</a>
                            @else
                                <a href="{{ route('chat_form', $chat->seller_id) }}" class="chat-button">Chat Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Function to load chats list based on the user's role
        function loadChats(searchQuery = '') {
            $.ajax({
                url: '{{ route("chats_list") }}',
                method: 'GET',
                data: { query: searchQuery },
                success: function(data) {
                    const chatsList = data.chats;
                    let html = '';

                    chatsList.forEach(chat => {
                        html += `
                            <div class="card chat-card">
                                <div class="card-header chat-card-header">
                                    Chat with ${chat.buyer_name || chat.seller_name}
                                </div>
                                <div class="card-body">
                                    <div class="chat-info">
                                        ${chat.buyer_email || 'Store: ' + chat.store_name}
                                    </div>
                                    <div class="mt-2">
                                        <a href="/chatsForm/${chat.buyer_id || chat.seller_id}" class="chat-button">Chat Now</a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    $('#chats-list').html(html);
                }
            });
        }

        // Initial Load
        loadChats();

        // Real-time search with AJAX
        $('#search-bar').on('input', function() {
            const query = $(this).val();
            loadChats(query);
        });
    </script>
</body>
</html>
