@extends('home.app')
@section('title', 'Môn học')
@section('content')
<div class="container py-5" style="min-height: 90vh;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary bg-opacity-25 rounded px-2 py-2">
            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home.category.all') }}" class="text-secondary text-decoration-none">Danh mục</a></li>
            <li class="breadcrumb-item">{{ $category->name }}</li>
        </ol>
    </nav>
    <div class="row">
        <h2 class="text-center">{{ $category->name }}</h2>
        <div class="row bg-secondary bg-opacity-25">
            @foreach ($category->quizzes as $quiz)
                <div class="col-lg-3 my-3">
                    <div class="card shadow">
                        <img src="{{ asset('storage/quiz_image/'.$quiz->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $quiz->title }}</h5>
                            <p class="card-text">{{ $quiz->description }}</p>
                            <a href="{{ route('quiz.detail', ['id' => $quiz->id]) }}" class="btn btn-outline-dark">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
