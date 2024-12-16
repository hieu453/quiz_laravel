@extends('home.app')
@section('title', 'Môn học')
@section('content')
<div class="container py-5">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home.category.all') }}" class="text-secondary text-decoration-none">Danh mục</a></li>
                <li class="breadcrumb-item">{{ $category->name }}</li>
            </ol>
        </nav>

        <h2 class="text-center">{{ $category->name }}</h2>
        <div class="row">
            @foreach ($category->quizzes as $quiz)
                <div class="col-lg-3 my-3">
                    <div class="card border-dark">
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
