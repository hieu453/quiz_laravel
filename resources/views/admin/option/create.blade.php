@extends('admin.app')
@section('content')
    @if(! $questions->isEmpty())
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('option.store') }}" method="POST" id="optionForm">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Question</label>
                <select name="question_id" id="questionSelected" class="form-select">
                    @foreach($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Option 1</label>
                <input name="options[0][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Is correct</label>
                <input class="form-check-input" name="correct" value="0" type="radio">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Option 2</label>
                <input name="options[1][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Is correct</label>
                <input class="form-check-input" name="correct" value="1" type="radio">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Option 3</label>
                <input name="options[2][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Is correct</label>
                <input class="form-check-input" name="correct" value="2" type="radio">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Option 4</label>
                <input name="options[3][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>Is correct</label>
                <input class="form-check-input" name="correct" value="3" type="radio">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <div>No question</div>
    @endif
@endsection
