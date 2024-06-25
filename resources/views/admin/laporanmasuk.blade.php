@extends('layouts.appadmin')

@section('content')
<div class="container mt-5">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Laporan Pengguna</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama Pelapor</th>
                                    <th>Email Pelapor</th>
                                    <th>Produk</th>
                                    <th>Nama Terlapor</th>
                                    <th>Email Terlapor</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->user->name }}</td>
                                        <td>{{ $report->user->email }}</td>
                                        <td><a href="{{ route('products.show', $report->product->id) }}">{{ $report->product->title }}</a></td>
                                        <td>{{ $report->product->user->name }}</td>
                                        <td>{{ $report->product->user->email }}</td>
                                        <td>{{ $report->reason }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('admin.tolak', $report->id) }}" method="POST" class="mr-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                                <form action="{{ route('admin.blokirPengguna', $report->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Blokir Pengguna</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <small class="text-muted">Total laporan: {{ count($reports) }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function blockUser(userId) {
        $.ajax({
            url: '/admin/block-user/' + userId,
            type: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                alert('Pengguna berhasil diblokir!');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat memblokir pengguna.');
            }
        });
    }
</script>
@endsection
