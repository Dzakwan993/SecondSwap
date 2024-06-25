@extends('layouts.app')

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
                <ol class="breadcrumb">
                <button onclick="location.href='{{ url()->previous() }}'" class="btn btn-secondary">
                            Kembali
                        </button>
                </ol>
            </nav>
            <div class="d-flex flex-wrap justify-content-between">
                <div class="card col-12 col-md-5 mb-3 mb-md-0">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="false">
                        <div class="carousel-inner">
                            @foreach(json_decode($product->image) as $arr => $product_pic)
                            <div class="carousel-item {{$arr == 0 ? 'active' : ''}}">
                                <img src="{{ asset('storage/assets/uploads/'.$product_pic) }}" class="card-img-top img-fluid d-block w-100" alt="...">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="card col-12 col-md-6">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="card-top-left">
                                <h1>{{ $product->title }}</h1>
                                @if($product->price == 0)
                                    <h3 class="text-info">Gratis</h3>
                                @else
                                    <h3 class="text-info">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                                @endif
                                <p>
                                    Diposting oleh
                                    <br>
                                    <a href="{{ route('profile.show', $product->user->id) }}">{{ $product->user->username }}</a>
                                </p>
                            </div>

                            <div class="card-top-right text-right mt-3 mt-md-0">
                                <span class="badge @if($product->sold) badge-warning @else badge-primary @endif">
                                    @if( $product->sold )
                                    Terjual
                                    @else
                                    Tersedia
                                    @endif
                                </span>
                                <form action="{{ route('products.favorite', $product) }}" method="POST" class="favorite-form">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        @auth
                                            <i class="{{ Auth::user()->favorites->where('product_id', $product->id)->count() ? 'fas fa-heart text-danger' : 'far fa-heart' }}"></i>
                                        @else
                                            <i class="far fa-heart"></i>
                                        @endauth
                                    </button>
                                </form>

                                @auth
                                @if(Auth::user()->id == $product->user_id)
                                <div class="btn-group btn-group-sm mt-md-4" role="group" aria-label="Basic example">
                                    <a href="{{ route('products.edit', $product->id) }}" type="button" class="btn btn-primary" id="edit-product">
                                        <i class="fas fa-pen-square"></i>
                                    </a>

                                    <a type="button" class="btn btn-secondary" id="delete-product">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form style="display:none" action="{{ route('products.destroy',$product->id) }}" id="{{ 'form-delete-'.$product->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                                @endif
                                @endauth
                            </div>
                        </div>
                        <hr>
                        <div class="card-bottom">
                            <p>
                                <strong>{{ $product->description }}</strong>
                            </p>
                            <span>
                                Diposting pada {{ $product->created_at }}
                            </span>
                            <span>
                                <p>{{ $product->province->name }}, {{ $product->regency->name }}, {{ $product->district->name }}</p>
                            </span>
                            <br><br><br>
                            <a href="{{ route('chat.start', ['receiver_id' => $product->user_id]) }}" style="background-color: green; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Chat dengan penjual</a>
                            <hr>
                            <a href="{{ route('products.report', $product->id) }}" style="background-color: red; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Laporkan Barang Ini</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-secondary rounded-sm my-md-2 text-center text-light">
                Beri Komentar
            </div>

            @auth
            <div class="comment mb-2">
                <div class="card">
                    <div class="card-body">
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                        <div id="comment-error"></div>
                        <button type="button" class="btn btn-primary my-md-2" id="btn-comment">Kirim</button>
                    </div>
                </div>
            </div>
            @endauth
            @guest
            <div class="mb-2">
                <p>Masuk Untuk Berkomentar</p>
            </div>
            @endguest

            <div id="comment-content">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/delete_product.js') }}"></script>
<script src="{{ asset('js/comments.js') }}"></script>
<script src="{{ asset('js/favorite.js') }}"></script>
@endsection
