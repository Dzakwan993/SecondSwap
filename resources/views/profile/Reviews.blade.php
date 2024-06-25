@extends('layouts.app')

@section('styles')
<style>
    .rating {
        font-size: 24px;
    }

    .rating .star {
        color: #ccc; /* Warna bintang default */
        font-size: 24px;
    }

    .rating .star.selected {
        color: gold; /* Warna bintang saat rating lebih besar dari atau sama dengan nilai rating ulasan */
    }

    .review-card {
        background-color: #f8f9fa; /* Warna latar belakang kartu */
        border: 1px solid #dee2e6; /* Warna border kartu */
        border-radius: 5px; /* Border radius kartu */
        margin-bottom: 20px; /* Jarak antar kartu */
    }

    .review-card .card-body {
        padding: 20px; /* Padding dalam kartu */
    }

    .review-card .card-title {
        font-weight: bold;
        color: black;
        margin-bottom: 10px; /* Margin bawah judul kartu */
    }

    .review-card .card-text {
        margin-top: 10px; /* Margin atas teks ulasan */
    }

    .average-rating {
        font-size: 28px; /* Ukuran font rating rata-rata */
        font-weight: bold; /* Tebal font rating rata-rata */
        margin-left: 10px; /* Jarak kiri rating rata-rata */
        color: gold;
    }

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
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb d-flex justify-content-between">
                    <div class="brd-left">
                        <button onclick="location.href='{{ url()->previous() }}'" class="btn btn-secondary">
                            Kembali
                        </button>
                    </div>

                    <div class="brd-right">
                        @if($averageRating !== null)
                            <li>
                                <i class="fas fa-star" style="color: gold;"></i>
                                <span class="average-rating">{{ number_format($averageRating, 1) }}</span>
                            </li>
                        @endif
                    </div>
                </ol>
            </nav>
            <div class="d-flex flex-wrap" id="reviews-container">
                @forelse($reviews as $review)
                    <div class="review-card card mt-2 w-100">
                        <div class="card-body">
                            <h6 class="card-title">{{ $review->user->name }}</h6>
                            <div class="rating mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'selected' : '' }}">&#9733;</span>
                                @endfor
                            </div>
                            <p class="card-text">{{ $review->description }}</p>
                        </div>
                    </div>
                @empty
                    <p>Kamu belum mempunyai ulasan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
