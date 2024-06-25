@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporkan Produk</h2>
    <form method="POST" action="{{ route('products.storeReport', $product->id) }}">
        @csrf
        <div class="form-group">
            <label for="reason">Alasan:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Laporkan</button>
    </form>
</div>
@endsection
