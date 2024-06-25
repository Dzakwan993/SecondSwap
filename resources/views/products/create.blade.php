@extends('layouts.app')

@section('styles')
<style>
    .card-header {
        text-align: center; /* Center the text */
        background-color: #4ba3e7; /* Use the same blue color */
        color: white; /* White text color */
        font-size: 1.5rem;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .form-group label {
        font-weight: bold;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        background-color: white;
        padding: 20px;
    }

    @media (max-width: 576px) {
        .form-group .col-md-4, .form-group .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .form-group .col-md-4 {
            text-align: left;
        }
    }

    .file-input {
        display: flex;
        flex-direction: column;
    }

    .file-input .img-input {
        margin-top: 5px;
    }

    .btn-primary {
        background-color: #4ba3e7;
        border-color: #4ba3e7;
    }

    .btn-primary:hover {
        background-color: #3a91d6;
        border-color: #3a91d6;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Jual Barang Bekas</div> <!-- Ensure the text is centered -->
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Judul</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Deskripsi</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" autocomplete="description">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Kategori</label>
                            <div class="col-md-6">
                                @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="checkbox-{{ $category->id }}" name="categories[]" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkbox-{{ $category->id }}">
                                        {{ $category->category }}
                                    </label>
                                </div>
                                @endforeach
                                @error('categories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="province" class="col-md-4 col-form-label text-md-right">Provinsi</label>
                            <div class="col-md-6">
                                <select name="province" id="province" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="regency" class="col-md-4 col-form-label text-md-right">Kabupaten/Kota</label>
                            <div class="col-md-6">
                                <select name="regency" id="regency" class="form-control">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    <!-- Opsi untuk kota akan diisi menggunakan JavaScript -->
                                </select>
                                @error('regency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">Kecamatan</label>
                            <div class="col-md-6">
                                <select name="district" id="district" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                    <!-- Opsi untuk kecamatan akan diisi menggunakan JavaScript -->
                                </select>
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Harga</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" id="price" value="{{ old('price') }}">
                                </div>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Gambar</label>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" id="btn-add">+</button>
                                <button type="button" class="btn btn-danger" id="btn-min">-</button>
                                <div class="file-input">
                                    <div class="input-increment">
                                        <input class="mt-3 img-input form-control-file" type="file" name="image[]">
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Format gambar yang diperbolehkan: JPG, PNG, JPEG, BMP. Dimensi maksimum: 4000x4000 piksel.
                                </small>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="form-create-product">
                                    Jual
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="img-fil d-none">
                        <div class="added-input">
                            <input class="mt-3 img-input form-control-file" type="file" name="image[]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/create_product.js') }}"></script>
<script>
   $(document).ready(function(){
    // Maintain selected values after form submission
    let oldRegency = "{{ old('regency') }}";
    let oldDistrict = "{{ old('district') }}";
    let provinceId = "{{ old('province') }}";

    // Fetch regencies if province is selected
    if(provinceId){
        $.ajax({
            type:"GET",
            url:"/get-regencies",
            data:{province_id:provinceId},
            dataType:'json',
            success:function(data){
                $('#regency').empty();
                $('#district').empty(); 
                $('#regency').append('<option value="">Pilih Kabupaten/Kota</option>');
                $.each(data, function(key, value){
                    $('#regency').append('<option value="'+value.id+'" '+(value.id == oldRegency ? 'selected' : '')+'>'+value.name+'</option>');
                });
            }
        });
    }

    // Fetch districts if regency is selected
    if(oldRegency){
        $.ajax({
            type:"GET",
            url:"/get-districts",
            data:{regency_id:oldRegency},
            dataType:'json',
            success:function(data){
                $('#district').empty();
                $('#district').append('<option value="">Pilih Kecamatan</option>');
                $.each(data, function(key, value){
                    $('#district').append('<option value="'+value.id+'" '+(value.id == oldDistrict ? 'selected' : '')+'>'+value.name+'</option>');
                });
            }
        });
    }

    $('#province').change(function(){
        var provinceId = $(this).val();
        if(provinceId){
            // Kirim permintaan AJAX untuk mengambil data kabupaten/kota berdasarkan id provinsi
            $.ajax({
                type:"GET",
                url:"/get-regencies",
                data:{province_id:provinceId},
                dataType:'json',
                success:function(data){
                    $('#regency').empty();
                    $('#district').empty(); // Mengosongkan pilihan kecamatan saat provinsi berubah
                    $('#regency').append('<option value="">Pilih Kabupaten/Kota</option>');
                    $.each(data, function(key, value){
                        $('#regency').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
        }else{
            $('#regency').empty();
            $('#district').empty(); // Mengosongkan pilihan kecamatan saat provinsi dikosongkan
        }
    });

    $('#regency').change(function(){
        var regencyId = $(this).val();
        if(regencyId){
            // Kirim permintaan AJAX untuk mengambil data kecamatan berdasarkan id kabupaten/kota
            $.ajax({
                type:"GET",
                url:"/get-districts",
                data:{regency_id:regencyId},
                dataType:'json',
                success:function(data){
                    $('#district').empty();
                    $('#district').append('<option value="">Pilih Kecamatan</option>');
                    $.each(data, function(key, value){
                        $('#district').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
        }else{
            $('#district').empty();
        }
    });
});
</script>
@endsection
