@extends('home.app')
@section('content')
    <div class="mt-5">
        <h2 id="timer">50:00</h2>
        <form id="question-form" action="{{ route('checkResult') }}" method="POST">
            @csrf
            @foreach($questions as $question)
                <h4>{{ $question->title }}</h4>
                @foreach($question->options as $option)
                    <div class="form-check">
                        <input type="hidden" value="{{ count($questions) }}" name="number_of_questions">
                        <input class="form-check-input" type="radio" name="answers[answer_{{ $question->id }}]" id="flexRadioDefault1" value="{{ $option->is_correct }}">
                        <label class="form-check-label" for="flexRadioDefault1">
                            {{ $option->text }}
                        </label>
                    </div>
                @endforeach
            @endforeach
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
@push('javascript')
    <script>
        function startTimer(duration, display) {
            const questionForm = document.getElementById('question-form');
            var timer = duration, minutes, seconds;
            const x = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(x);
                    questionForm.submit();
                }
            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = 60 * 50,
                display = document.querySelector('#timer');
            startTimer(fiveMinutes, display);
        };
    </script>
@endpush
