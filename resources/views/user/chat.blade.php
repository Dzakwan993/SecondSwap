@extends('layouts.app')

@section('styles')
<style>
    .breadcrumb .brd-left button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
    }

    .breadcrumb .brd-left button:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }

    #chat-wrapper {
        flex-wrap: wrap;
    }

    .friends-list, .chat-container {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .friends-list, .chat-container {
            flex: 1 1 100%;
        }
    }

    @media (min-width: 769px) {
        .friends-list {
            flex: 0 0 30%;
        }

        .chat-container {
            flex: 0 0 68%;
            margin-left: 2%;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb d-flex justify-content-between">
                    <div class="brd-left">
                        <button onclick="location.href='{{ url()->previous() }}'" class="btn btn-secondary">
                            Kembali
                        </button>
                    </div>
                </ol>
            </nav>
            <div class="d-flex flex-wrap border rounded bg-white py-3 px-2" id="chat-wrapper">
                <div class="col-12 col-md-4 p-0 friends-list">
                    <!-- Friends list content here -->
                </div>
                <div class="col-12 col-md-8 p-0 chat-container">
                    <div class="border rounded shadow-sm p-1 ml-md-3 justify-content-center">
                        <div class="chat-message-box overflow-auto" style="max-height: 300px;" id="chat-box">
                            <!-- Chat messages will be displayed here -->
                        </div>
                        <div class="input-group d-none" id="message-form">
                            <input type="text" name="message" class="form-control" id="message">
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="btn-msg"><i class="fas fa-paper-plane"></i></button>
                            </div>
                            <div id="message-error"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/chat.js') }}"></script>
<script>
$(document).ready(function() {
    $('.user-friend').on('click', function() {
        var friendId = $(this).data('id');
        fetchMessages(friendId);
    });

    $('#btn-msg').on('click', function() {
        sendMessage();
    });

    function fetchMessages(friendId) {
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/profile/${pathArray[2]}/chat/friends/${friendId}`,
            headers: {
                'X-CSRF-TOKEN': token
            },
            method: "GET",
            dataType: "json",
            success: function(response) {
                displayMessages(response);
                $('#message-form').removeClass('d-none');
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function displayMessages(messages) {
        let chatBox = $('#chat-box');
        chatBox.empty();

        messages.forEach(message => {
            let messageElement = createMessageElement(message);
            chatBox.append(messageElement);
        });

        chatBox.scrollTop(chatBox[0].scrollHeight);
    }

    function createMessageElement(message) {
        let messageWrapper = $('<div>').addClass('d-flex mb-2').addClass(message.user_id == "{{ Auth::id() }}" ? 'justify-content-end' : 'justify-content-start');
        let messageContent = $('<div>').addClass('alert').addClass(message.user_id == "{{ Auth::id() }}" ? 'alert-primary' : 'alert-secondary').text(message.message);
        messageWrapper.append(messageContent);
        return messageWrapper;
    }

    function sendMessage() {
        let messageBody = $('#message').val();
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/profile/${pathArray[2]}/chat/friends/${friendId}`,
            headers: {
                'X-CSRF-TOKEN': token
            },
            method: "POST",
            dataType: "json",
            data: {
                message: messageBody
            },
            success: function(response) {
                let newMessage = createMessageElement(response);
                $('#chat-box').append(newMessage);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                $('#message').val('');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
</script>
@endsection
