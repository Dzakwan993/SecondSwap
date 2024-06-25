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

    .card {
    background-color: white;
    height: 300px;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    margin-right: 8px; /* Tambahkan margin kanan */
    margin-left: 8px; /* Tambahkan margin kiri */
}


    .card-img-container {
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-img-top {
        max-width: 100%;
        max-height: 100%;
        object-fit: scale-down;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 15px;
    }

    .card-text {
        margin-bottom: 10px;
    }

    #products-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-right: -8px; /* Kompensasi margin kanan */
    margin-left: -8px; /* Kompensasi margin kiri */
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
                        <li>
                            <span class="badge badge-primary">{{ $products->count() }}</span>
                        </li>
                    </div>
                </ol>
            </nav>
            <div class="d-flex flex-wrap" id="products-container">
                @include('products.products')
            </div>
        </div>
        @auth
        <div class="col-md-2">
            <a href="{{ route('products.create') }}" type="button" class="btn btn-primary">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
                Jual Barang
            </a>
        </div>
        @endauth
    </div>
</div>
@endsection
