@extends('admin.app')
@section('title', 'Danh mục | Tất cả')
@section('content')
{{-- Modal Delete --}}
@include('admin.categories.modals.delete-modal')
{{-- Modal Add --}}
@include('admin.categories.modals.add-modal')

<div class="container-fluid px-4">
    <h1 class="mt-4">Tất cả danh mục</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                Thêm danh mục
            </button>
        </div>
        <div class="card-body">
            <table id="categoriesTable" class="table table-striped">
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Tên</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Tạo lúc</th>
                    <th>Sửa lúc</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td></td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td><span class="badge rounded-pill text-bg-{{ $category->status ? 'primary' : 'danger' }}">{{ $category->status ? 'Đang mở' : 'Đã khóa' }}</span></td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-outline-success">Sửa</a>
                            <a class="btn btn-sm btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#categoryDeleteModal">Xóa</a>
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
    datatable('#categoriesTable', '#categoryDeleteModal', "{{ route('category.deleteMultiple') }}", [2])
</script>
@endpush
