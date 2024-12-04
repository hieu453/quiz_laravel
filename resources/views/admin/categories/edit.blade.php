@extends('admin.app')
@section('title', 'Danh mục | Sửa')
@section('content')
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="my-3 mx-3">
        <div class="row">
            <div class="col-6">
                <h2>Sửa danh mục</h2>
            </div>
            <div class="col-6">
                <a href="{{ route('category.all') }}" class="btn btn-secondary float-end">Trở lại</a>
            </div>
        </div>
        <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">Tiêu đề</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
@endsection
