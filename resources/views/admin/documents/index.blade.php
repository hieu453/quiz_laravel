@extends('admin.app')
@section('title', 'Tài liệu | Tất cả')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tất cả tài liệu</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
                Thêm tài liệu
            </button>
        </div>
        <div class="card-body">
            <table id="documentsTable" class="table table-striped">
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Câu hỏi</th>
                        <th>Link Youtube</th>
                        <th>Link tài liệu</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Câu hỏi</th>
                    <th>Link Youtube</th>
                    <th>Link tài liệu</th>
                    <th>Sửa lúc</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td></td>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->youtube_link }}</td>
                        <td>{{ $document->document_link }}</td>
                        <td>{{ $document->created_at }}</td>
                        <td>{{ $document->updated_at }}</td>
                        <td>
                            <a href="{{ route('document.edit', ['id' => $document->id]) }}" class="btn btn-sm btn-outline-success">Sửa</a>
                            <a class="btn btn-sm btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#documentDeleteModal">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@push('javascript')
<script>
    datatable('#documentsTable', '#documentDeleteModal', "{{ route('category.deleteMultiple') }}", [2,3,4])
</script>
@endpush
