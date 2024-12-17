@extends('admin.app')
@section('title', 'Môn học | Sửa')
@section('content')
@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="mx-3 my-3">
    <div class="row">
        <div class="col-6">
            <h2>Sửa môn học</h2>
        </div>
        <div class="col-6">
            <a href="{{ route('quiz.all') }}" class="btn btn-secondary float-end">Trở lại</a>
        </div>
    </div>
    <form action="{{ route('quiz.update', ['id' => $quiz->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $quiz->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $quiz->title }}">
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Thời gian</label>
                    <input type="number" value="{{ $quiz->time }}" class="form-control" name="time" min="10" max="50" step="1" oninput="this.value = Math.round(this.value);">
                </div>
                <div class="col-6">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="0" {{ $quiz->status == 0 ? 'selected' : '' }}>Khóa</option>
                        <option value="1" {{ $quiz->status == 1 ? 'selected' : '' }}>Mở</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ $quiz->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
</div>
@endsection
