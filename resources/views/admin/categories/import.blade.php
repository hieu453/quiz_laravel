@extends('admin.app')
@section('title', 'Danh mục | Import Excel')
@section('content')
    @error('spreadsheet')
        <div class="alert alert-danger">Bạn phải chọn file.</div>
    @enderror
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('category.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Chọn file danh mục</label>
            <input type="file" name="spreadsheet" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
        <a href="{{ route('category.all') }}" class="btn btn-secondary">Trở lại</a>
    </form>
@endsection
