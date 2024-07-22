@extends('admin.app')
@section('content')
    <form action="{{ route('quiz.update', ['id' => $quiz->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Quiz</label>
            <input type="text" name="title" class="form-control" value="{{ $quiz->title }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
