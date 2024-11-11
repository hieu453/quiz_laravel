@extends('admin.app')
@section('content')
    <form action="{{ route('question.update', ['id' => $question->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Quiz</label>
            <select class="form-select" name="quiz_id">
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ $question->quizz->id == $quiz->id ? "selected" : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Question</label>
            <input name="title" type="text" class="form-control" value="{{ $question->title }}">
        </div>
        @foreach ($question->options as $key => $option)
            <div class="mb-3">
                <label class="form-label fw-bold">Option {{ $key + 1 }}</label>
                <input name="options[{{ $key }}][option_id]" type="hidden" value="{{ $option->id }}">
                <input name="options[{{ $key }}][text]" type="text" class="form-control" value="{{ $option->text }}">
                <label>Correct</label>
                <input name="correct" value="{{ $option->id }}" type="radio" {{ $option->is_correct == 1 ? 'checked' : ''}}>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
