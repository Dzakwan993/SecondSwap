@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Chat</h2>
            <div class="card">
                <div class="card-header">Chat dengan {{ $receiver->username }}</div>
                <div class="card-body" id="chat-box">
                    <!-- Chat messages will be displayed here -->
                    @foreach($messages as $message)
                        @if($message->user_id == Auth::user()->id)
                            <div class="d-flex justify-content-end mb-2">
                                <div class="alert alert-primary" role="alert">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-start mb-2">
                                <div class="alert alert-secondary" role="alert">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card-footer">
                    <form id="message-form">
                        <div class="input-group">
                            <input type="text" class="form-control" id="message" placeholder="Ketikkan Pesan...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Fungsi untuk mengirim pesan melalui AJAX
    function sendMessage() {
        var message = document.getElementById('message').value;
        var receiverId = "{{ $receiver->id }}"; // Ambil ID penerima dari variabel Blade
        var senderId = "{{ Auth::id() }}"; // Ambil ID pengirim dari user yang sedang login
        var token = "{{ csrf_token() }}"; // Ambil token CSRF

        // Kirim permintaan AJAX ke backend
        $.ajax({
            type: "POST",
            url: "/profile/{{ Auth::user()->id }}/chat/friends/" + receiverId,
            data: {
                message: message,
                _token: token
            },
            success: function(response) {
                // Berhasil mengirim pesan, perbarui tampilan obrolan
                updateChatBox(message, true); // Pass true to indicate the message is from the current user
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Fungsi untuk memperbarui kotak obrolan setelah mengirim pesan
    function updateChatBox(messageContent, isCurrentUser) {
        // Append the message content to the chat box
        var chatBox = document.getElementById('chat-box');
        var newMessage = document.createElement('div');
        var messageWrapper = document.createElement('div');
        newMessage.classList.add('alert', isCurrentUser ? 'alert-primary' : 'alert-secondary', 'my-2', 'py-2', 'px-3', 'rounded');
        newMessage.innerHTML = messageContent;

        // Add alignment class based on the user
        messageWrapper.classList.add('d-flex', isCurrentUser ? 'justify-content-end' : 'justify-content-start', 'mb-2');
        messageWrapper.appendChild(newMessage);
        chatBox.appendChild(messageWrapper);

        // Clear the input field after sending the message
        document.getElementById('message').value = '';
    }

    // Tangkap event form submission
    document.getElementById('message-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Hindari pengiriman form standar
        sendMessage(); // Panggil fungsi untuk mengirim pesan
    });
</script>
@endsection
