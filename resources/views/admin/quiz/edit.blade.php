@extends('admin.app')
@section('content')
    <form action="{{ route('quiz.update', ['id' => $quiz->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Quiz</label>
            <input type="text" name="title" class="form-control" value="{{ $quiz->title }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $quiz->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
