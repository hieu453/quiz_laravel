@extends('home.app')
@section('content')
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    @foreach ($questions as $key => $question)
                        <div class="row border border-success rounded mb-3">
                            <h5>Câu {{ $key + 1 }}: {{ $question->title }}</h5>
                            @foreach ($question->options as $option)
                                @if ($userAnswers)
                                    @if (count($userAnswers) == count($questions))
                                        @foreach ($userAnswers as $answer)
                                            @if ($answer->id == $option->id && $answer->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check" style="background-color: #add8e6;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div>
                                            @elseif ($option->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check" style="background-color: #90ee90;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div>
                                            @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check" style="background-color: #f2476a;">
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
                                        @endforeach
                                    @else
                                        @php $answeredFlag = false @endphp
                                        @foreach ($userAnswers as $answer)
                                            @if ($answer->id == $option->id && $answer->is_correct && $answer->question->id == $question->id)
                                                @php $answeredFlag = true @endphp
                                                <div class="form-check" style="background-color: #add8e6;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                    <label>(Đáp án của bạn)</label>
                                                </div>
                                            @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                                @php $answeredFlag = true @endphp
                                                <div class="form-check" style="background-color: #f2476a;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                    <label>(Đáp án của bạn)</label>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if (!$answeredFlag)
                                        <div class="form-check {{ $option->is_correct ? 'correct-option' : '' }}">
                                            <label class="form-check-label">
                                                {{ $option->text }}
                                            </label>
                                        </div>
                                        @endif
                                        @php $answeredFlag = false @endphp
                                    @endif
                                @else
                                    <div class="form-check {{ $option->is_correct ? 'correct-option' : '' }}">
                                        <label class="form-check-label">
                                            {{ $option->text }} hello
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column ps-5" style="position: fixed; top: 20%;">
                        <div class="d-flex flex-row">
                            <div class="annotation-box mb-2" style="background-color: #f2476a;">

                            </div>
                            <p>: Đáp án của bạn sai</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="annotation-box mb-2" style="background-color: #add8e6;">

                            </div>
                            <p>: Đáp án của bạn đúng</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="annotation-box mb-2" style="background-color: #90ee90;">

                            </div>
                            <p>: Đáp án của câu hỏi</p>
                        </div>
                    </div>
                    <div style="position: fixed; margin-top: 12%; margin-left: 5%;">
                        <p><b>Số câu đã làm: {{ $userAnswers ? count($userAnswers) : 0 }}/{{ count($questions) }}</b></p>
                        <p><b>Số câu làm đúng: {{ $userCorrectAnswers }}/{{ $userAnswers ? count($userAnswers) : 0 }}</b></p>
                        <a href="{{ route('quiz.start', ['id' => $question->quiz_id]) }}" class="btn btn-info">Làm lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
