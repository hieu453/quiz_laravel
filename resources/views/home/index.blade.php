@extends('home.app')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Quizzes</h1>
        <div class="row">
            @foreach($quizzes as $quiz)
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">{{ $quiz->title }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('quiz.questions.show', ['id' => $quiz->id]) }}">Test</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
{{--    <div class="mt-5">--}}
{{--        <form action="{{ route('checkResult') }}" method="POST">--}}
{{--            @csrf--}}
{{--            @foreach($questions as $question)--}}
{{--                <h4>{{ $question->title }}</h4>--}}
{{--                @foreach($question->options as $option)--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="radio" name="answers[answer_{{ $question->id }}]" id="flexRadioDefault1" value="{{ $option->is_correct }}">--}}
{{--                        <label class="form-check-label" for="flexRadioDefault1">--}}
{{--                            {{ $option->text }}--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endforeach--}}
{{--            <button type="submit" class="btn btn-primary mt-3">Submit</button>--}}
{{--        </form>--}}
{{--    </div>--}}
@endsection
