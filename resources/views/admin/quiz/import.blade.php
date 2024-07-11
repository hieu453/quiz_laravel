@extends('admin.app')
@section('content')
    <form action="{{ route('quiz.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Quiz</label>
            <input type="file" name="spreadsheet" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
