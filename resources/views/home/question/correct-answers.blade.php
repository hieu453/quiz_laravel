@extends('home.app')
@section('content')
    <div class="mt-5">
        @foreach($questions as $question)
            <h4>{{ $question->title }}</h4>
            @foreach($question->options as $option)
                @foreach($userAnswers as $answer)
                    @if ($option->question_id == $answer->question_id)

                        {{-- @if ($answer->is_correct == 1 && $option->is_correct == 1)
                            <div class="form-check" style="background-color: aqua">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @else
                            @if ()
                            <div class="form-check">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $option->text }}
                                </label>
                            </div>
                            @else

                            @endif
                        @endif --}}
                        @if ($answer->id == $option->id && $answer->is_correct == 1)
                            <div class="form-check" style="background-color: aqua">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @else
                            @if ($answer->id == $option->id && $answer->is_correct == 0)
                            <div class="form-check" style="background-color: red">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $option->text }}
                                </label>
                            </div>
                            @else
                                @if ($option->is_correct == 1)
                                    <div class="form-check" style="background-color: aqua">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @else
                                    <div class="form-check">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @endif

                            @endif
                        @endif
                    @endif
                @endforeach
            @endforeach
        @endforeach
    </div>
@endsection
