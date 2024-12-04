@extends('admin.app')
@section('title', 'Lựa chọn | Thêm')
@section('content')
    @if(! $questions->isEmpty())
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @error('correct')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <form action="{{ route('option.store') }}" method="POST" id="optionForm">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Câu hỏi</label>
                <select name="question_id" id="questionSelected" class="form-select">
                    @foreach($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lựa chọn 1</label>
                <input name="options[0][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Đúng</label>
                <input class="form-check-input" name="correct" value="0" type="radio">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lựa chọn 2</label>
                <input name="options[1][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Đúng</label>
                <input class="form-check-input" name="correct" value="1" type="radio">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lựa chọn 3</label>
                <input name="options[2][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Đúng</label>
                <input class="form-check-input" name="correct" value="2" type="radio">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lựa chọn 4</label>
                <input name="options[3][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Đúng</label>
                <input class="form-check-input" name="correct" value="3" type="radio">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    @else
        <div class="my-2">
            <h2>Tất cả câu hỏi đã được thêm lựa chọn</h2>
        </div>
    @endif
@endsection
