<style>
.card {
    background-color: white;
    height: 300px;
    margin: 8px;
}

.card-img-container {
    position: relative;
    overflow: hidden;
    border: 2px solid #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 200px;
}

.card-img-container img {
    width: auto;
    max-height: 100%;
    display: block;
    margin: 0 auto;
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

.card-footer {
    text-align: center;
}
</style>


@foreach($favorites as $favorite)
<a href="{{ route('products.show', $favorite->product->id) }}" class="col-md-3 p-0 shadow-sm text-decoration-none text-dark">
    <div class="card">
        <div class="card-img-container">
            <img src="{{ asset('storage/assets/uploads/'.json_decode($favorite->product->image)[0]) }}" class="card-img-top img-fluid" style="object-fit: cover; height: 100%;" alt="...">
        </div>

        <div class="card-body">
                    <h5 class="card-title">{{ $favorite->product->title }}</h5>
                    <p class="card-text">
                        @if ($favorite->product->price == 0)
                            <strong>Gratis</strong>
                        @else
                            <strong>Rp {{ number_format($favorite->product->price, 0, ',', '.') }}</strong>
                        @endif
                    </p>
                </div>

        <div class="card-footer">
            <form action="{{ route('favorites.remove', $favorite->id) }}" method="POST" class="remove-favorite-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
            </form>
        </div>
    </div>
</a>        
@endforeach
