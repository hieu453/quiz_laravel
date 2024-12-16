@extends('home.app')
@section('title', $quiz->title)
@section('content')
  <!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalTitle">Cần đăng nhập</h1>
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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home.category.all') }}" class="text-secondary text-decoration-none">Danh mục</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home.category.show', ['slug' => $quiz->category->slug]) }}" class="text-secondary text-decoration-none">{{ $quiz->category->name }}</a></li>
            <li class="breadcrumb-item">{{ $quiz->title }}</li>
        </ol>
    </nav>

    <div class="py-5">
        <h1>{{ $quiz->title }}</h1>
        <p>{{ $quiz->description }}</p>
        @if (Auth::check())
            <a href="{{ route('questions.session', ['id' => $quiz->id]) }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-hand-point-right"></i>
                Bắt đầu làm bài!
            </a>
        @else
            <!-- Button trigger modal -->
            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fa-solid fa-hand-point-right"></i>
                Bắt đầu làm bài!
            </a>
        @endif
        <a href="{{ route('quiz.documents', ['id' => $quiz->id]) }}" class="btn btn-outline-secondary">Xem tài liệu</a>
    </div>

    <div class="row">
        <h3 class="text-center">Top điểm cao</h3>
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Điểm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topFiveUsers as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Comment section --}}
    @include('home.quiz.comments.index', ['quiz' => $quiz, 'comments' => $comments, 'commentsAndRepliesLength' => $commentsAndRepliesLength])
    {{-- Rating section --}}
    <livewire:rating :quizId="$quiz->id"></livewire:rating>
</div>
@endsection
