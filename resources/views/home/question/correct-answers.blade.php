@extends('home.app')
@section('title', 'Đáp án')
@section('content')
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-6 bg-secondary bg-opacity-25 px-5 py-3 shadow-sm">
                    <h3 class="text-center">Đáp án</h3>
                    @foreach ($questions as $key => $question)
                        <div class="row mb-3 bg-white px-2 py-3 rounded shadow-sm">
                            <h5>Câu {{ $key + 1 }}: {{ $question->title }}</h5>
                            @foreach ($question->options as $option)
                                @if ($userAnswers)
                                    @if (count($userAnswers) == count($questions))
                                        @foreach ($userAnswers as $answer)
                                            @if ($answer->id == $option->id && $answer->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check rounded-pill" style="background-color: #add8e6;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div>
                                            @elseif ($option->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check rounded-pill" style="background-color: #90ee90;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                </div>
                                            @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                                <div class="form-check rounded-pill" style="background-color: #f2476a;">
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
                                                <div class="form-check rounded-pill" style="background-color: #add8e6;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                    {{-- <label>(Đáp án của bạn)</label> --}}
                                                </div>
                                            @elseif ($answer->id == $option->id && !$answer->is_correct && $answer->question->id == $question->id)
                                                @php $answeredFlag = true @endphp
                                                <div class="form-check rounded-pill" style="background-color: #f2476a;">
                                                    <label class="form-check-label">
                                                        {{ $option->text }}
                                                    </label>
                                                    {{-- <label>(Đáp án của bạn)</label> --}}
                                                </div>
                                            @endif
                                        @endforeach
                                        @if (!$answeredFlag)
                                        <div class="form-check rounded-pill {{ $option->is_correct ? 'correct-option' : '' }}">
                                            <label class="form-check-label">
                                                {{ $option->text }}
                                            </label>
                                        </div>
                                        @endif
                                        @php $answeredFlag = false @endphp
                                    @endif
                                @else
                                    <div class="form-check rounded-pill {{ $option->is_correct ? 'correct-option' : '' }}">
                                        <label class="form-check-label">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    <div class="mt-5">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h5>Phản hồi (nếu có câu hỏi nào đáp án chưa đúng hoặc chưa có đáp án, hãy phản hồi rõ tên câu hỏi và đáp án đúng)</h5>
                        <form action="{{ route('feedback.send') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="feedback" class="form-control" required></textarea>
                            </div>
                            <button class="btn btn-outline-dark">Gửi phản hồi</button>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column ps-5" style="position: fixed; top: 20%;">
                        <div class="d-flex flex-row">
                            <div class="annotation-box rounded-pill mb-2" style="background-color: #f2476a;">

                            </div>
                            <p>: Đáp án của bạn sai</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="annotation-box rounded-pill mb-2" style="background-color: #add8e6;">

                            </div>
                            <p>: Đáp án của bạn đúng</p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="annotation-box rounded-pill mb-2" style="background-color: #90ee90;">

                            </div>
                            <p>: Đáp án của câu hỏi</p>
                        </div>
                    </div>
                    <div style="position: fixed; margin-top: 12%; margin-left: 5%;">
                        <p><b>Số câu đã làm: {{ $userAnswers ? count($userAnswers) : 0 }}/{{ count($questions) }}</b></p>
                        <p><b>Số câu làm đúng: {{ $userCorrectAnswers }}/{{ $userAnswers ? count($userAnswers) : 0 }}</b></p>
                        {{-- Biến $question vẫn còn tồn tại sau khi kết thúc foreach --}}
                        <a href="{{ route('quiz.start', ['id' => $question->quiz_id]) }}" class="btn btn-outline-dark">Làm lại</a>
                        <a href="{{ route('quiz.detail', ['id' => $question->quiz_id]) }}" class="btn btn-outline-secondary">Thảo luận</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
