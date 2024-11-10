@extends('home.app')
@section('content')
    <div class="mt-5">
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
                                        @endforeach
                                    @else
                                        @php $answeredFlag = false @endphp
                                        @foreach ($userAnswers as $answer)
                                            @if ($answer->id == $option->id && $answer->is_correct && $answer->question->id == $question->id)
                                                @php $answeredFlag = true @endphp
                                                <div class="form-check" style="background-color: aqua;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div>
                                            {{-- @elseif ($option->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check" style="background-color: green;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div> --}}
                                            @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                                @php $answeredFlag = true @endphp
                                                <div class="form-check" style="background-color: red;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div>
                                            {{-- @elseif ($answer->question->id == $question->id && !$answer->is_correct)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div> --}}
                                            @endif
                                        @endforeach
                                        @if (!$answeredFlag)
                                        <div class="form-check {{ $option->is_correct ? 'bg-success' : '' }}">
                                            <label class="form-check-label">
                                                {{ $option->text }}
                                            </label>
                                        </div>
                                        @endif
                                        @php $answeredFlag = false @endphp
                                    @endif
                                @else
                                    <div class="form-check {{ $option->is_correct ? 'bg-success' : '' }}">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column align-items-center">
                        <div class="d-flex flex-row">
                            <div class="annotation-box mb-2" style="background-color: red;">

                            </div>
                            <p>: hello</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="annotation-box mb-2" style="background-color: green;">

                            </div>
                            <p>: hello</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="annotation-box mb-2" style="background-color: aqua;">

                            </div>
                            <p>: hello</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
