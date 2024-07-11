@extends('admin.app')
@section('content')
    @if(empty($questions))
        <form action="{{ route('option.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Question</label>
                <select name="question_id">
                    @foreach($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Option 1</label>
                <input name="options[0][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>is correct</label>
                <input name="options[0][is_correct]" type="radio">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Option 2</label>
                <input name="options[1][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>is correct</label>
                <input name="options[1][is_correct]" type="radio">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Option 3</label>
                <input name="options[2][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>is correct</label>
                <input name="options[2][is_correct]" type="radio">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Option 4</label>
                <input name="options[3][text]" type="text" class="form-control" id="exampleInputPassword1">
                <label>is correct</label>
                <input name="options[3][is_correct]" type="radio">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <div>No question</div>
    @endif
@endsection
