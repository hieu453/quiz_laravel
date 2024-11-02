@extends('admin.app')
@section('content')
    <!-- Modal Delete -->
    @include('admin.categories.modals.delete-modal')
    {{-- Modal Add --}}
    @include('admin.categories.modals.add-modal')

    <div class="container-fluid px-4">
        <h1 class="mt-4">All Categories</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    Add Categories
                </button>
            </div>
            <div class="card-body">
                <table id="categoriesTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td></td>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-success">Update</a>
                                <a class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#categoryDeleteModal">Delete</a>
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
    const columnsSettings = [
        { searchable: false },
        { searchable: false },
        null,
        { searchable: false },
        { searchable: false },
        { searchable: false },
        { searchable: false },
    ]
    datatable('#categoriesTable', '#categoryDeleteModal', "{{ route('category.deleteMultiple') }}", columnsSettings)
</script>
@endpush
