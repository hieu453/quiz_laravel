@extends('admin.app')
@section('content')
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Quiz</label>
            <input type="text" name="title" class="form-control" id="exampleInputText1" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
