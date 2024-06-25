<style>
    .rating {

        font-size: 24px;
        cursor: pointer;
    }

    .rating .star {
        color: #ccc;
        /* Warna bintang default */
    }

    .rating .star.hover,
    .rating .star:hover,
    .rating .star.selected {
        color: gold;
        /* Warna bintang saat di-hover atau dipilih */
    }

    .rating .star.selected {
        color: gold;
        /* Warna bintang saat rating lebih besar dari atau sama dengan nilai rating ulasan */
    }

    .profile-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.profile-card .card-header {
    background-color: #007bff;
    color: white;
    font-size: 1.5rem;
    border-radius: 10px 10px 0 0;
    padding: 10px 20px;
}

.user-profile-container {
    padding: 20px;
}

.profile-pic {
    max-width: 150px;
    border: 3px solid #007bff;
    padding: 5px;
}

.user-name {
    margin-top: 15px;
    font-size: 1.75rem;
    color: #333;
}

.user-info {
    margin: 10px 0;
    font-size: 1rem;
    color: #555;
}

.user-rating {
    margin-top: 10px;
    font-size: 1.25rem;
    color: #555;
}
</style>


@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card profile-card">
                <div class="card-header text-center">Profil Pengguna</div>
                <div class="card-body">
                    <div class="text-center user-profile-container">
                        <img src="{{ asset('storage/assets/profile_pic/' . $user->photo) }}"
                            class="rounded-circle profile-pic" alt="Profile Picture">
                        <h2 class="user-name">{{ $user->name }}</h2>
                        <p class="user-info"><strong>Nama Pengguna:</strong> {{ $user->username }}</p>
                        <p class="user-info"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="user-info"><strong>Nomor Telepon:</strong> {{ $user->phone }}</p>
                        <p class="user-info"><strong>Alamat:</strong> {{ $user->address }}</p>
                        <p class="user-rating">
                            <i class="fas fa-star" style="color: gold;"></i>
                            <span class="average-rating">{{ number_format($averageRating, 1) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>Berikan Ulasan</h3>
    <form method="POST" action="{{ route('reviews.store', $user->id) }}">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">&#9733;</span>
                @endfor
                <input type="hidden" name="rating" id="rating">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Beri Ulasan</button>
    </form>

    {{-- Menampilkan Ulasan --}}
    @if($user->reviews->isNotEmpty())
        <h3>Ulasan Akun</h3>
        <div class="reviews-container">
            @foreach($user->reviews->chunk(2) as $reviewChunk)
                <div class="row">
                    @foreach($reviewChunk as $review)
                        <div class="col-md-6">
                            <div class="card review-card">
                                <div class="card-body">
                                    <strong>{{ $review->user->name }}:</strong>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star {{ $i <= $review->rating ? 'selected' : '' }}">&#9733;</span>
                                        @endfor
                                    </div>
                                    <p>{{ $review->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @else
        <p>No reviews yet.</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                ratingInput.value = this.getAttribute('data-value');
                updateStars(ratingInput.value);
            });
            star.addEventListener('mouseover', function () {
                updateStars(this.getAttribute('data-value'), true);
            });
            star.addEventListener('mouseout', function () {
                updateStars(ratingInput.value);
            });
        });

        function updateStars(rating, hover = false) {
            stars.forEach(star => {
                let starValue = star.getAttribute('data-value');
                if (starValue <= rating) {
                    if (hover) {
                        star.classList.add('hover');
                    } else {
                        star.classList.add('selected');
                        star.classList.remove('hover');
                    }
                } else {
                    star.classList.remove('selected', 'hover');
                }
            });
        }
    });
</script>

@endsection