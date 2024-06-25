@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 text-center">
            <div class="card">
                <div class="card-header">Dashboard Admin</div>

                <div class="card-body">
                   <h1>Selamat datang admin! <i class="fas fa-hand-wave"></i></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-sm-6 col-md-4 text-center mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>Laporan Masuk</h3>
                    <a href="{{ route('admin.laporanmasuk') }}" class="btn btn-primary mt-auto">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 text-center mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>Laporan Ditindak</h3>
                    <a href="{{ route('admin.ditindak') }}" class="btn btn-primary mt-auto">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 text-center mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>Laporan Ditolak</h3>
                    <a href="{{ route('admin.ditolak') }}" class="btn btn-primary mt-auto">Lihat</a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-md-3 text-center mt-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>Kelola Kategori Barang</h3>
                    <a href="{{ route('admin.kategori') }}" class="btn btn-primary mt-auto">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 text-center mt-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3>Kelola Carousel</h3>
                    <a href="{{ route('admin.carousel.index') }}" class="btn btn-primary mt-auto">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function blockUser(userId) {
        // Lakukan permintaan AJAX untuk memblokir pengguna
        $.ajax({
            url: '/admin/block-user/' + userId,
            type: 'POST', // Gunakan metode POST
            data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                alert('Pengguna berhasil diblokir!');
                // Refresh halaman setelah blokir pengguna
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat memblokir pengguna.');
            }
        });
    }
</script>
@endsection

@section('styles')
<style>
    .card {
        min-height: 200px; /* Pastikan tinggi minimum sama untuk semua kotak */
    }
</style>
@endsection
