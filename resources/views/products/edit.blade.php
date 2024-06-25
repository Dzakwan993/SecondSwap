@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                <div class="card-header">Edit Secondhand Stuff</div>


                <div class="card-body">

                    <div id="carouselExampleControls" class="carousel slide" data-ride="false">
                        <div class="carousel-inner">
                            @foreach(json_decode($product->image) as $arr => $product_pic)
                            <div class="carousel-item {{$arr == 0 ? 'active' : ''}}">
                                <img src="{{ asset('storage/assets/uploads/'.$product_pic) }}" class="card-img-top img-fluid d-block w-100 alt=" ...">
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

                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="sold" class="col-md-4 col-form-label text-md-right">Sold</label>

                            <div class="col-md-6">
                                <label>No </label>
                                <input type="checkbox" class="toggle" value="{{ $product->sold }}" id="sold_toggle" name="sold">
                                <label> Yes</label>


                                @error('sold')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $product->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" autocomplete="title">{{ old('description') ?? $product->description }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

                            <div class="col-md-6">
                                @foreach($categories as $category)

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="checkbox-{{ $category->id }}" name="categories[]">
                                    <label class="form-check-label" for="checkbox-{{ $category->id }}" id="label-{{ $category->id }}">
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

                         <!-- Field untuk memilih Provinsi -->
                         <div class="form-group row">
                            <label for="province" class="col-md-4 col-form-label text-md-right">Province</label>
                            <div class="col-md-6">
                                <select name="province" id="province" class="form-control">
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $product->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Field untuk memilih Kabupaten/Kota -->
                        <div class="form-group row">
                            <label for="regency" class="col-md-4 col-form-label text-md-right">Regency</label>
                            <div class="col-md-6">
                                <select name="regency" id="regency" class="form-control">
                                    <option value="">Select Regency</option>
                                    @foreach($regencies as $regency)
                                        <option value="{{ $regency->id }}" {{ $product->regency_id == $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                                    @endforeach
                                </select>
                                @error('regency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Field untuk memilih Kecamatan -->
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">District</label>
                            <div class="col-md-6">
                                <select name="district" id="district" class="form-control">
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $product->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" id="price" value="{{ old('price') ?? $product->price }}">
                                </div>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                            <div class="col-md-6">
                                <button class="btn btn-primary" id="btn-add">+</button>
                                <button class="btn btn-danger" id="btn-min">-</button>
                                <div class="file-input">

                                    <div class="input-increment">
                                        <input class="mt-3 img-input form-control-file" type="file" name="image[]">
                                    </div>

                                </div>


                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
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
<script src="{{ asset('js/edit_product.js') }}"></script>
    <script>
   $(document).ready(function(){
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
                    $('#regency').append('<option value="">Select Regency</option>');
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
                    $('#district').append('<option value="">Select District</option>');
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