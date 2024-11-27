@extends('home.app')
@section('content')
{{-- Modal when click submit btn --}}
<div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Bạn có chắc muốn nộp bài?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="modal-body">
          ...
        </div> --}}
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button id="submit-exam" type="button" class="btn btn-primary">Nộp</button>
        </div>
      </div>
    </div>
</div>
{{-- Content --}}
<div class="container py-5">
        <form id="question-form" action="{{ route('checkResult') }}" method="POST">
            @csrf
            <input type="hidden" name="number_of_questions" value="{{ count($questions) }}">
            <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">

            <div class="row">
                <div class="col-6">
                    @foreach($questions as $key => $question)
                        <div id="question_{{ $key + 1 }}" class="row border border-success rounded mb-3 px-2 py-2" style="scroll-margin: 70px;">
                            <h5>Câu {{ $key + 1 . ': ' . $question->title }}</h5>
                            @foreach($question->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input radio answer_{{ $key + 1 }}" type="radio" name="answers[answer_{{ $question->id }}]" id="radio_{{ $option->id }}" value="{{ $option->id }}">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $option->text }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-6">
                    <div class="d-flex flex-row" style="position: fixed;">
                        @foreach ($questions as $key => $question)
                        <a href="#question_{{ $key + 1 }}" class="text-decoration-none text-reset">
                            <div class="checkbox-choose-question text-center me-1" id="checkboxAnswer_{{ $key + 1 }}">
                                {{ $key + 1 }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="row mt-5" style="position: fixed;">
                        <span>Thời gian:</span>
                        <h4 id="timer"></h4>
                    </div>
                    <div class="row" style="position: fixed; margin: 130px 0 0 0;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitModal">
                            Nộp bài
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('javascript')
    <script>
        const questions = {{ count($questions) }};
        const checkedBox = JSON.parse(localStorage.getItem('checkedBox')) ?? {};
        for (let i = 1; i <= questions; i++) {
            $(`.answer_${i}`).change(function() {
                $(`#checkboxAnswer_${i}`).addClass('bg-info text-white')
                checkedBox[i] = i
                localStorage.setItem('checkedBox', JSON.stringify(checkedBox))
            })
        }


        $(document).ready(function() {
            const checkedBox = JSON.parse(localStorage.getItem('checkedBox'))
            if (checkedBox) {
                for (let index of Object.values(checkedBox)) {
                    $(`#checkboxAnswer_${checkedBox[index]}`).addClass('bg-info text-white')
                }
            }

            // Show remaining time
            let minutes = 50;
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
                localStorage.removeItem('checkedBox');
                questionForm.submit();
            });

            // when click submit button
            // questionForm.on('submit', (e) => {
            //     e.preventDefault();
            //     if (confirm('Bạn có chắc muốn nộp bài?')) {
            //         timer.stop();
            //         localStorage.removeItem('currentTime');
            //         localStorage.removeItem('selected');
            //         localStorage.removeItem('checkedBox');
            //         questionForm[0].submit();
            //     }
            // })

            $('#submit-exam').on('click', (e) => {
                timer.stop();
                localStorage.removeItem('currentTime');
                localStorage.removeItem('selected');
                localStorage.removeItem('checkedBox');
                questionForm.submit();
            })

            // remain answers
            //get the selected radios from storage, or create a new empty object
            var radioGroups = JSON.parse(localStorage.getItem('selected') ?? '{}');

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
