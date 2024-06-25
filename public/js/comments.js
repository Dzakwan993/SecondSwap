var pathArray = window.location.pathname.split('/');
getComments();

function formatDate(dateString) {
  const date = new Date(dateString);
  const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
  return date.toLocaleDateString('id-ID', options);
}

function getComments() {
  $.get(`/product/${pathArray[2]}/comments`)
    .done(renderComments)
    .fail(handleError)
    .always(subscribeToCommentChannel);
}

function renderComments(data) {
  let commentsHTML = '<div class="card mb-1"><div class="card-body">'; // Start card for all comments
  data.forEach((comment) => {
    commentsHTML += generateCommentHTML(comment);
  });
  commentsHTML += '</div></div>'; // End card for all comments
  $('#comment-content').html(commentsHTML);
}

function generateCommentHTML(comment) {
  return `
    <div class="d-flex align-items-start mb-1">
      <div class="mr-1">
        <img src="/storage/assets/profile_pic/${comment.user.photo}" class="img-fluid rounded-circle" style="max-width: 25px;" alt="profile-picture">
      </div>
      <div>
        <p class="m-0"><strong>${comment.user.username}</strong> <small class="text-muted"> ${diffForHumans(comment.created_at)}</small></p>
        <p>${comment.body}</p>
        
      </div>
    </div>
  `;
}

// Example diffForHumans function (for illustration purposes)
function diffForHumans(date) {
  const now = new Date();
  const diff = now - new Date(date);
  const seconds = Math.floor(diff / 1000);
  const minutes = Math.floor(seconds / 60);
  const hours = Math.floor(minutes / 60);
  const days = Math.floor(hours / 24);

  if (seconds < 60) return `${seconds} detik yang lalu`;
  if (minutes < 60) return `${minutes} menit yang lalu`;
  if (hours < 24) return `${hours} jam yang lalu`;
  return `${days} hari yang lalu`;
}


function handleError(error) {
  console.log(error);
}

function subscribeToCommentChannel() {
  Echo.channel(`product.${pathArray[2]}`).listen('NewComment', function(data) {
    const newCommentHTML = generateCommentHTML(data.comment);
    $('#comment-content').prepend(newCommentHTML);
  });
}

$('#btn-comment').on('click', function() {
  const commentBody = $('#comment').val();
  postComment(commentBody);
});

function postComment(commentBody) {
  $.ajax({
    url: `/product/${pathArray[2]}/comment`,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: "POST",
    dataType: "json",
    data: { comment: commentBody }
  })
  .done(function(data) {
    addNewComment(data); // Panggil fungsi addNewComment untuk menambahkan komentar baru ke dalam card
    $('#comment').val(''); // Clear comment input field
    $('#comment').removeClass('is-invalid'); // Remove any previous error styling
    $('#comment-error').empty(); // Clear any previous error messages
  })
  .fail(showCommentError);
}

function addNewComment(data) {
  const newCommentHTML = generateCommentHTML(data); // Memanggil generateCommentHTML dengan data yang diterima dari server
  $('#comment-content').prepend(newCommentHTML); // Menambahkan komentar baru ke dalam card di bagian atas (prepend)
}



function showCommentError(error) {
  $('#comment').addClass('is-invalid');
  const errorMessage = error.responseJSON.errors.comment[0];
  $('#comment-error').html(`<p class='m-0 text-danger'>${errorMessage}</p>`);
}
