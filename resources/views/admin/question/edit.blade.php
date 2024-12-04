@extends('admin.app')
@section('title', 'Câu hỏi | Sửa')
@section('content')
@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('options')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
<div class="mx-3 my-3">
    <div class="row">
        <div class="col-6">
            <h2>Sửa câu hỏi</h2>
        </div>
        <div class="col-6">
            <a href="{{ route('question.all') }}" class="btn btn-secondary float-end">Trở lại</a>
        </div>
    </div>
    <form action="{{ route('question.update', ['id' => $question->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-bold">Đề</label>
            <select class="form-select" name="quiz_id">
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ $question->quizz->id == $quiz->id ? "selected" : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Tiêu đề</label>
            <input name="title" type="text" class="form-control" value="{{ $question->title }}">
        </div>
        @foreach ($question->options as $key => $option)
            <div class="mb-3">
                <label class="form-label fw-bold">Lựa chọn {{ $key + 1 }}</label>
                <input name="options[{{ $key }}][option_id]" type="hidden" value="{{ $option->id }}">
                <input name="options[{{ $key }}][text]" type="text" class="form-control" value="{{ $option->text }}">
                <label>Đúng</label>
                <input name="correct" value="{{ $option->id }}" type="radio" {{ $option->is_correct == 1 ? 'checked' : ''}}>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
</div>
@endsection
