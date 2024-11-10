@extends('home.app')
@section('content')
    <div class="mt-5">
        <div class="container">
        {{-- @foreach($questions as $question)
            <h4>{{ $question->title }}</h4>
            @foreach($question->options as $option)
                @foreach($userAnswers as $answer)
                    @if ($option->question_id == $answer->question_id)
                        @if ($answer->id == $option->id && $answer->is_correct == 1)
                            <div class="form-check" style="background-color: aqua">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @else
                            @if ($answer->id == $option->id && $answer->is_correct == 0)
                                <div class="form-check" style="background-color: red">
                                    <label class="form-check-label">
                                        {{ $option->text }}
                                    </label>
                                </div>
                            @else
                                @if ($option->is_correct == 1)
                                    <div class="form-check" style="background-color: aqua">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @else
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @endif

                            @endif
                        @endif
                    @else
                        @if ($option->is_correct)
                            <div class="form-check" style="background-color: rgb(14, 141, 41)">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endforeach
        @endforeach --}}
        {{-- @if ($userAnswers->has($key) && $userAnswers[$key]->id == $question->id)
                        @if ($userAnswers[$key]->is_correct && $option->text == $userAnswers[$key]->text)
                            <div class="form-check" style="background-color: aqua">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @elseif (!$userAnswers[$key]->is_correct && $option->text == $userAnswers[$key]->text)
                            <div class="form-check" style="background-color: red;">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @elseif ($option->is_correct)
                            <div class="form-check" style="background-color: green;">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ $option->text }}
                                </label>
                            </div>
                        @endif
                    @else
                        <div class="form-check">
                            <label class="form-check-label {{ $option->is_corret ? 'bg-success' : '' }}">
                                {{ $option->text }}
                            </label>
                        </div>
                    @endif --}}

            @foreach ($questions as $key => $question)
                <h2>{{ $question->title }}</h2>
                @foreach ($question->options as $option)
                    @if ($userAnswers)
                        @foreach ($userAnswers as $answer)
                            @if (count($userAnswers) == count($questions))
                                @if ($answer->id == $option->id && $answer->is_correct && $answer->question->id == $question->id)
                                    <div class="form-check" style="background-color: aqua;">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @elseif ($option->is_correct && $answer->question->id == $question->id)
                                    <div class="form-check" style="background-color: green;">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                    <div class="form-check" style="background-color: red;">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @elseif ($answer->question->id == $question->id && !$option->is_correct)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @endif
                            @else
                                @if ($answer->id == $option->id && $answer->is_correct && $answer->question->id == $question->id)
                                    <div class="form-check" style="background-color: aqua;">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @elseif ($option->is_correct && $answer->question->id == $question->id)
                                    <div class="form-check" style="background-color: green;">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                    <div class="form-check" style="background-color: red;">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @elseif ($answer->question->id == $question->id && !$option->is_correct)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @else
                                    <div class="form-check {{ $option->is_correct ? 'bg-success' : '' }}">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @else
                        <div class="form-check {{ $option->is_correct ? 'bg-success' : '' }}">
                            <label class="form-check-label">
                                {{ $option->text }}
                            </label>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
