<style>

.card {
    background-color: white;
    height: 300px;
    margin: 8px;
}

.card-img-container {
        position: relative;
        /* Memastikan posisi relatif untuk mengontrol elemen anak */
        overflow: hidden;
        /* Menghindari gambar melebihi kontainer */
        border: 2px solid #fff;
 
        border-radius: 8px;
        /* Melengkungkan sudut bingkai */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Efek bayangan untuk memberi kedalaman */
        height: 200px;
        /* Menetapkan tinggi kontainer gambar */
    }

    .card-img-container img {
        width: auto;
        /* Menjaga proporsi gambar */
        max-height: 100%;
        /* Maksimum tinggi gambar adalah 100% dari tinggi kontainer */
        display: block;
        /* Memastikan elemen inline yang tepat */
        margin: 0 auto;
        /* Pusatkan gambar secara horizontal */
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

</style>
@foreach($products as $product)
    <a href="{{ route('products.show', $product->id) }}" class="col-md-3 p-0 shadow-sm text-decoration-none text-dark">
        <div class="card">
            <div class="card-img-container">
                <img src="{{ asset('storage/assets/uploads/'.json_decode($product->image)[0]) }}" class="card-img-top img-fluid" style="object-fit: cover; height: 100%;" alt="...">
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $product->title }}</h5>
                @if($product->price == 0)
                    <p class="card-text"><strong>Gratis</strong></p>
                @else
                    <p class="card-text"><strong>Rp {{ $product->price }}</strong></p>
                @endif
            </div>
        </div>
    </a>
@endforeach


