@extends('home.app')
@section('content')
    <div class="mt-5">
        <h2 id="timer"></h2>
        <form id="question-form" action="{{ route('checkResult') }}" method="POST">
            @csrf
            @foreach($questions as $question)
                <h4>{{ $question->title }}</h4>
                @foreach($question->options as $option)
                    <div class="form-check">
                        <input type="hidden" name="number_of_questions" value="{{ count($questions) }}">
                        <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">
                        <input class="form-check-input radio" type="radio" name="answers[answer_{{ $question->id }}]" id="radio_{{ $option->id }}" value="{{ $option->id }}">
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
        $(document).ready(function() {
            // Show remaining time
            let minutes = 2;
            let seconds = 0;
            const questionForm = $('#question-form');

            if (localStorage.getItem('currentTime')) {
                minutes = JSON.parse(localStorage.getItem('currentTime')).minutes
                seconds = JSON.parse(localStorage.getItem('currentTime')).seconds
            }

            var timer = new Timer(/* default config */);
            timer.start({
                precision: 'seconds',
                countdown: true,
                startValues: {
                    minutes: minutes,
                    seconds: seconds
                },
                target: {
                    seconds: 0
                }
            });
            // Initialize time
            $("#timer").html(timer.getTimeValues().toString());

            // update every seconds
            timer.addEventListener("secondsUpdated", function (e) {
                $("#timer").html(timer.getTimeValues().toString());
                let currentTime = {
                    'minutes': timer.getTimeValues().minutes,
                    'seconds': timer.getTimeValues().seconds
                }
                localStorage.setItem('currentTime', JSON.stringify(currentTime))
            });

            // when time reaches 0 then remove all localStorage and submit form
            timer.addEventListener('targetAchieved', function () {
                timer.stop();
                localStorage.removeItem('currentTime');
                localStorage.removeItem('selected');
                questionForm.submit();
            });

            // when click submit button
            questionForm.on('submit', () => {
                timer.stop();
                localStorage.removeItem('currentTime');
                localStorage.removeItem('selected');
            })


            // remain answers
            //get the selected radios from storage, or create a new empty object
            var radioGroups = JSON.parse(localStorage.getItem('selected') || '{}');

            //loop over the ids we previously selected and select them again
            Object.values(radioGroups).forEach(function(radioId){
                document.getElementById(radioId).checked = true;
            });

            //handle the click of each radio
            $('.radio').on('click', function(){
                //set the id in the object based on the radio group name
                //the name lets us segregate the values and easily replace
                //previously selected radios in the same group
                radioGroups[this.name] = this.id;
                //finally store the updated object in storage for later use
                localStorage.setItem("selected", JSON.stringify(radioGroups));
            });
        });
    </script>
@endpush
