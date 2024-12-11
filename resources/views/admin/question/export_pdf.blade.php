@extends('admin.app')
@section('title', 'Môn học | Export câu hỏi')
@section('content')
<div class="mb-3">
    <label class="form-label">Môn học</label>
    <form action="{{ route('question.export.download') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <select class="form-select" name="quiz_id">
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline-dark">Export</button>
        <a href="{{ route('question.all') }}" class="btn btn-outline-secondary">Trở lại</a>
    </form>
</div>
@endsection
