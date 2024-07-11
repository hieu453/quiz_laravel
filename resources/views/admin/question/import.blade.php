@extends('admin.app')
@section('content')
    <form action="{{ route('question.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Quiz</label>
            <select name="quiz_id">
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Spreadsheet file</label>
            <input type="file" name="spreadsheet" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
