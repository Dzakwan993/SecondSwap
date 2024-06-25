let pathArray = window.location.pathname.split('/');
let friendId;

getFriends();

function getFriends() {
    $.get(`/profile/${pathArray[2]}/chat/friends`)
        .done((data) => {
            for (let i = 0; i < data.length; i++) {
                if (pathArray[2] != data[i].id) {
                    let unreadMessages = data[i].unread_messages > 0 ? '<span class="badge badge-danger">!</span>' : '';
                    $('.friends-list')
                        .append(`<a style="cursor: pointer;" class="friend-${data[i].id} text-body">
                            <div class="user-friend d-flex border rounded shadow-sm p-1 mb-2">
                                <img src="/storage/assets/profile_pic/${data[i].photo}" class="img-fluid rounded-circle mr-2" style="max-width: 30px;" alt="profile-picture">
                                <p class="m-0">${data[i].username} ${unreadMessages}</p>
                            </div>
                        </a>`);
                    $(`.friend-${data[i].id}`).on('click', () => {
                        friendId = data[i].id;
                        $.post(`/profile/${pathArray[2]}/chat/friends/${data[i].id}/read`, {_token: $('meta[name="csrf-token"]').attr('content')})
                            .done(() => {
                                // Tandai pesan sebagai sudah dibaca
                                $(`.friend-${data[i].id} .badge`).remove();
                            });
                        $.get(`/profile/${pathArray[2]}/chat/friends/${data[i].id}`)
                            .done((msg) => {
                                $('.chat-message-box').empty();
                                for (let i = 0; i < msg.length; i++) {
                                    if (msg[i].user_id == pathArray[2]) {
                                        $('.chat-message-box')
                                            .append(`<div class="user-chat col-6 offset-6 p-0 text-right">
                                                <p class="d-inline-flex bg-primary text-white p-2 rounded">${msg[i].message}</p>
                                            </div>`);
                                    } else if (msg[i].user.id == friendId) {
                                        $('.chat-message-box')
                                            .append(`<div class="friend-chat p-0 col-6">
                                                <p class="d-inline-flex bg-secondary text-white p-2 rounded">${msg[i].message}</p>
                                            </div>`);
                                    }
                                }
                            })
                            .fail((error) => {
                                console.log(error);
                            })
                            .always(() => {
                                Echo.channel(`chat.${pathArray[2]}`)
                                    .listen('NewPrivateMessage', (msg) => {
                                        $('.chat-message-box')
                                            .append(`<div class="friend-chat p-0 col-6">
                                                <p class="d-inline-flex bg-secondary text-white p-2 rounded">${msg.message.message}</p>
                                            </div>`);
                                    });
                            });
                        $('#message-form').removeClass('d-none');
                        window.scrollTo(0, 99999);
                    });
                }
            }
        })
        .fail((error) => {
            console.log(error);
        });
}

$('#btn-msg').on('click', () => {
    let message_body = $('#message').val();
    let token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: `/profile/${pathArray[2]}/chat/friends/${friendId}`,
        headers: {
            'X-CSRF-TOKEN': token
        },
        method: "post",
        dataType: "json",
        data: {
            message: message_body
        },
        success: function(response) {
            updateChatBox(message_body, true);
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

function updateChatBox(messageContent, isCurrentUser) {
    var chatBox = document.getElementById('chat-box');
    var newMessage = document.createElement('div');
    var messageWrapper = document.createElement('div');
    newMessage.classList.add('alert', isCurrentUser ? 'alert-primary' : 'alert-secondary', 'my-2', 'py-2', 'px-3', 'rounded');
    newMessage.innerHTML = messageContent;

    messageWrapper.classList.add('d-flex', isCurrentUser ? 'justify-content-end' : 'justify-content-start', 'mb-2');
    messageWrapper.appendChild(newMessage);
    chatBox.appendChild(messageWrapper);

    document.getElementById('message').value = '';
}
