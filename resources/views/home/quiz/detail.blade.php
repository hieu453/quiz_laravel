@extends('home.app')
@section('content')
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Đăng nhập để làm bài
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Đăng ký</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row rounded py-5" style="background-image: linear-gradient(#e7f0fd, #accbee)">
        <h1>{{ $quiz->title }}</h1>
        <p>{{ $quiz->description }}</p>
        @if (Auth::check())
            <a href="{{ route('quiz.start', ['id' => $quiz->id]) }}" class="text-success text-decoration-none play-link">
                <i class="fa-solid fa-hand-point-right"></i>
                Bắt đầu làm bài!
            </a>
        @else
            <!-- Button trigger modal -->
            <a class="text-success text-decoration-none play-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-hand-point-right"></i>
                Bắt đầu làm bài!
            </a>
        @endif
    </div>

    {{-- Comment section --}}
    @include('home.quiz.comments.index', ['quiz' => $quiz, 'comments' => $comments, 'commentsAndRepliesLength' => $commentsAndRepliesLength])
    {{-- Rating section --}}
    <livewire:rating :quizId="$quiz->id"></livewire:rating>
</div>
@endsection
