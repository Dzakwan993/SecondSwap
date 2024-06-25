<style>
    .card {
        background-color: white;
        height: 290px;
        display: flex;
        flex-direction: column;
        margin: 8px;
        /* Tambahkan margin untuk memberikan jarak antar card */
    }

    .card-img-container {
        position: relative;
        overflow: hidden;
        border: 2px solid #fff;
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

    .card-text {
        margin-bottom: 10px;
    }
    .card-img-container {
    overflow: hidden;
}

.zoom-img {
    transition: transform 0.5s ease;
}

.zoom-img:hover {
    transform: scale(1.1); /* Anda bisa mengatur skala sesuai kebutuhan */
}

</style>



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

    <div class="row">
        <div class="col-md-2">
            <div name="category" id="category" class="list-group">
                <a class="list-group-item list-group-item-action bg-secondary text-light disabled">Kategori</a>
                @foreach($categories as $category)
                    <a style="cursor: pointer;" data-category-id="{{ $category->id }}"
                        class="list-group-item list-group-item-action category-link">{{ $category->category }}</a>
                @endforeach
            </div>
        </div>

        <div class="col-md-8 mb-2">
            <div class="mb-2 input-group">
                <input class="form-control" type="text" name="search" id="search" placeholder="Cari Barang">
                <div class="input-group-append">
                    <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                </div>
            </div>


            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($carouselImages as $index => $carouselImage)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($carouselImages as $index => $carouselImage)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/carousel/' . $carouselImage->image_path) }}" class="d-block w-100"
                                alt="Carousel Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="col-md-2">
            @auth
                <a href="{{ route('products.create') }}" type="button" class="btn btn-primary">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                    Jual Barang
                </a>
            @endauth
            <br><br>

            <div class="form-group">
                <label for="province">Provinsi</label>
                <select class="form-control" id="province">
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="regency">Kabupaten/Kota</label>
                <select class="form-control" id="regency">
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
            </div>
            <div class="form-group">
                <label for="district">Kecamatan</label>
                <select class="form-control" id="district">
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-8 d-flex flex-wrap" id="products-container">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}"
                    class="col-md-3 p-0 shadow-sm text-decoration-none text-dark">
                    <div class="card">
                        <div class="card-img-container">
                            <img src="{{ asset('storage/assets/uploads/' . json_decode($product->image)[0]) }}"
                            class="card-img-top img-fluid zoom-img" style="object-fit: cover; height: 100%;"alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">
                                @if($product->price == 0)
                                    <strong>Gratis</strong>
                                @else
                                    <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                @endif
                            </p>
                            <p class="card-text"><small
                                    class="text-muted">{{ $product->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button id="load-more" class="btn btn-primary" style="display: none;">Muat Lainnya</button>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/search_product.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>



<script>
    $(document).ready(function () {
        var productsPerPage = 16;
        var currentProducts = [];
        var currentPage = 0;

        function displayProducts(products) {
            var start = currentPage * productsPerPage;
            var end = start + productsPerPage;
            var productsToShow = products.slice(start, end);

            $.each(productsToShow, function (key, value) {
                if (!value.user.is_blocked) { // Memeriksa apakah pengguna terkait diblokir
                    if (!value.sold) {
                        var images = JSON.parse(value.image);
                        var createdAtHumanReadable = moment(value.created_at).fromNow();
                        var productCard = '<a href="{{ route('products.show', '') }}/' + value.id + '" class="col-md-3 p-0 shadow-sm text-decoration-none text-dark">';
                        productCard += '<div class="card">';
                        productCard += '<div class="card-img-container" style="height: 200px; overflow: hidden;">';
                        productCard += '<img src="{{ asset('storage/assets/uploads/') }}/' + images[0] + '" class="card-img-top img-fluid zoom-img" style="object-fit: cover; height: 100%;" alt="' + value.name + '">';
                        productCard += '</div>';
                        productCard += '<div class="card-body">';
                        productCard += '<h5 class="card-title">' + value.title + '</h5>';
                        productCard += '<p class="card-text">';
                        if (value.price == 0) {
                            productCard += '<strong>Gratis</strong>';
                        } else {
                            productCard += '<strong>Rp ' + value.price.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) + '</strong>';
                        }
                        productCard += '</p>';
                        productCard += '<p class="card-text"><small class="text-muted">' + createdAtHumanReadable + '</small></p>';
                        productCard += '</div></div></a>';
                        $('#products-container').append(productCard);


                    }
                }
            });

            if (end >= products.length) {
                $('#load-more').hide();
            } else {
                $('#load-more').show();
            }
        }

        function loadProducts(districtId) {
            if (districtId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-products-by-district') }}/" + districtId,
                    success: function (res) {
                        if (res) {
                            // Filter produk berdasarkan status blokir pengguna terkait
                            res = res.filter(product => !product.user.is_blocked);
                            res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                            currentProducts = res;
                            currentPage = 0;
                            $('#products-container').empty();
                            displayProducts(currentProducts);
                        } else {
                            $('#products-container').html('<p>Produk tidak ditemukan</p>');
                        }
                    }
                });
            } else {
                $('#products-container').empty();
            }
        }

        function loadProductsByCategoryAndLocation(categoryId) {
            var selectedProvinceId = $('#province').val();
            var selectedRegencyId = $('#regency').val();
            var selectedDistrictId = $('#district').val();

            console.log("Loading products for category:", categoryId);
            console.log("Selected Province ID:", selectedProvinceId);
            console.log("Selected Regency ID:", selectedRegencyId);
            console.log("Selected District ID:", selectedDistrictId);

            if (categoryId) {
                $.ajax({
                    type: "GET",
                    url: "/get-products-by-category-and-location",
                    data: {
                        category_id: categoryId,
                        province_id: selectedProvinceId,
                        regency_id: selectedRegencyId,
                        district_id: selectedDistrictId
                    },
                    success: function (res) {
                        if (res) {
                            console.log("Products loaded:", res);
                            res.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                            currentProducts = res;
                            currentPage = 0;
                            $('#products-container').empty();
                            displayProducts(currentProducts);
                        } else {
                            $('#products-container').html('<p>No products found</p>');
                        }
                    },
                    error: function (err) {
                        console.error("Error loading products:", err);
                    }
                });
            } else {
                $('#products-container').empty();
            }
        }


        $('#load-more').click(function () {
            currentPage++;
            displayProducts(currentProducts);
        });

        var selectedProvince = localStorage.getItem('selectedProvince');
        var selectedRegency = localStorage.getItem('selectedRegency');
        var selectedDistrict = localStorage.getItem('selectedDistrict');

        if (selectedProvince) {
            $('#province').val(selectedProvince);
            updateRegencies(selectedProvince, selectedRegency, selectedDistrict);
        }
        if (selectedRegency) {
            $('#regency').val(selectedRegency);
            updateDistricts(selectedRegency, selectedDistrict);
        }
        if (selectedDistrict) {
            $('#district').val(selectedDistrict);
            loadProducts(selectedDistrict);
        }

        $('#province').change(function () {
            var provinceId = $(this).val();
            localStorage.setItem('selectedProvince', provinceId);
            updateRegencies(provinceId);
        });

        $('#regency').change(function () {
            var regencyId = $(this).val();
            localStorage.setItem('selectedRegency', regencyId);
            updateDistricts(regencyId);
        });

        $('#district').change(function () {
            var districtId = $(this).val();
            localStorage.setItem('selectedDistrict', districtId);
            loadProducts(districtId);
        });

        function updateRegencies(provinceId, selectedRegency = null, selectedDistrict = null) {
            if (provinceId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-regencies') }}?province_id=" + provinceId,
                    success: function (res) {
                        if (res) {
                            $("#regency").empty();
                            $("#regency").append('<option value="">Pilih Kabupaten/Kota</option>');
                            $.each(res, function (key, value) {
                                $("#regency").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            if (selectedRegency) {
                                $('#regency').val(selectedRegency);
                                updateDistricts(selectedRegency, selectedDistrict);
                            }
                        } else {
                            $("#regency").empty();
                        }
                    }
                });
            } else {
                $("#regency").empty();
                $("#district").empty();
            }
        }

        function updateDistricts(regencyId, selectedDistrict = null) {
            if (regencyId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts') }}?regency_id=" + regencyId,
                    success: function (res) {
                        if (res) {
                            $("#district").empty();
                            $("#district").append('<option value="">Pilih Kecamatan</option>');
                            $.each(res, function (key, value) {
                                $("#district").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            if (selectedDistrict) {
                                $('#district').val(selectedDistrict);
                            }
                        } else {
                            $("#district").empty();
                        }
                    }
                });
            } else {
                $("#district").empty();
            }
        }

        $('.category-link').click(function () {
            var categoryId = $(this).data('category-id');
            console.log("Category link clicked:", categoryId);
            loadProductsByCategoryAndLocation(categoryId);
        });
    });






</script>
@endsection

@section('footer')
<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('path_to_facebook_logo.png') }}" alt="Facebook" style="width: 30px; height: 30px;">
                <img src="{{ asset('path_to_instagram_logo.png') }}" alt="Instagram"
                    style="width: 30px; height: 30px; margin-left: 10px;">
                <img src="{{ asset('path_to_instagram_logo.png') }}" alt="Instagram"
                    style="width: 30px; height: 30px; margin-left: 10px;">
            </div>
            <div class="col-md-6 text-md-right">
                <p class="mb-0 text-light">Follow us on social media</p>
            </div>
        </div>
    </div>
</footer>
@endsection