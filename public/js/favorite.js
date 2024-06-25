document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const button = form.querySelector('button');
            const icon = button.querySelector('i');
            const url = form.action;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.isFavorited) {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'text-danger');
                } else {
                    icon.classList.remove('fas', 'text-danger');
                    icon.classList.add('far');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    document.querySelectorAll('.remove-favorite-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const confirmed = confirm('Are you sure you want to remove this favorite?');
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
});
