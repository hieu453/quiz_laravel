@extends('admin.app')
@section('title', 'Tài liệu | Sửa')
@section('content')
<div class="mx-3 my-3">
    <div class="row">
        <div class="col-6">
            <h2>Sửa tài liệu</h2>
        </div>
        <div class="col-6">
            <a href="{{ route('document.all') }}" class="btn btn-secondary float-end">Trở lại</a>
        </div>
    </div>
    <form action="{{ route('document.update', ['id' => $document->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="quiz_id" class="form-select">
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ $quiz->id == $document->quiz_id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Link Youtube</label>
            <input type="text" name="youtube_link" class="form-control" value="{{ $document->youtube_link }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Link tài liệu</label>
            <input type="text" name="document_link" class="form-control" value="{{ $document->document_link }}">
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
</div>
@endsection
