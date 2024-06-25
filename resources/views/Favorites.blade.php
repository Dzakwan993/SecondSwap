@extends('layouts.app')

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
                            <span class="badge badge-primary">{{ $favorites->count() }}</span>
                        </li>
                    </div>
                </ol>
            </nav>
            <div class="d-flex flex-wrap" id="products-container">
                @include('favorites_products')
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        background-color: white;
        height: 300px;
        display: flex;
        flex-direction: column;
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
    }

    .card-text {
        margin-bottom: 10px;
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
