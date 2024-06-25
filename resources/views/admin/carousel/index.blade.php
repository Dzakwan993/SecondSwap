@extends('layouts.appadmin')

@section('content')
<div class="container">
    <h1 class="my-4">Kelola Gambar Carousel</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h2>Unggah Gambar Baru</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Unggah Gambar</label>
                    <input type="file" class="form-control" name="image" id="image" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Unggah</button>
            </form>
        </div>
    </div>

    <h2 class="my-4">Gambar Carousel</h2>
    <div class="row">
        @foreach($carouselImages as $carouselImage)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/carousel/' . $carouselImage->image_path) }}" class="card-img-top" alt="Carousel Image">
                    <div class="card-body">
                        <form action="{{ route('admin.carousel.destroy', $carouselImage->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
