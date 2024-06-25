@extends('layouts.appadmin')

@section('content')
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col text-right">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#categoryModal">Tambah Kategori</button>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="categoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('admin.addCategory') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="category" placeholder="Kategori" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header bg-warning text-dark">
                    <h4 class="modal-title">Ubah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="editCategoryForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="text" name="category" id="editCategoryInput" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Category Table -->
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Kategori</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop through rejected reports --}}
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->category }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $category->id }}" data-category="{{ $category->category }}">Ubah</button>
                                <form action="{{ route('admin.deleteCategory', $category->id) }}" method="post" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <small class="text-muted">Total kategori: {{ count($categories) }}</small>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.edit-btn').on('click', function(){
            var id = $(this).data('id');
            var category = $(this).data('category');
            $('#editCategoryForm').attr('action', '/admin/editCategory/' + id);
            $('#editCategoryInput').val(category);
            $('#editCategoryModal').modal('show');
        });
    });
</script>
@endsection
