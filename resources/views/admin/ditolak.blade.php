@extends('layouts.appadmin')

@section('content')
<div class="container mt-5">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Laporan yang Ditolak</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Product ID</th>
                                    <th>Reason</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop through rejected reports --}}
                                @foreach($rejectedReports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->user_id }}</td>
                                        <td>{{ $report->product_id }}</td>
                                        <td>{{ $report->reason }}</td>
                                        <td>{{ $report->created_at }}</td>
                                        <td>{{ $report->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <small class="text-muted">Total laporan ditolak: {{ count($rejectedReports) }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
