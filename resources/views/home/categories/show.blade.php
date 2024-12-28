@extends('home.app')
@section('title', 'Môn học')
@section('content')
<div class="container py-5">
    <div class="row">
        {{-- <div class="col-2 py-5 mb-5 border rounded">
            <h2>Danh mục</h2>
            <ul class="" style="list-style-type: none;">
                @foreach ($categories as $item)
                    @if ($item->name == $category->name)
                        <li class="px-2 py-2 active rounded">
                            <a href="{{ route('home.category.show', ['slug' => $item->slug]) }}" class="text-secondary text-decoration-none">{{ $item->name }}</a>
                        </li>
                    @else
                        <li class="px-2 py-2 rounded">
                            <a href="{{ route('home.category.show', ['slug' => $item->slug]) }}" class="text-secondary text-decoration-none">{{ $item->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div> --}}
        <div class="col-10 py-5 mb-5 border rounded">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('home.category.all') }}" class="text-secondary text-decoration-none">Danh mục</a></li>
                    <li class="breadcrumb-item">{{ $category->name }}</li>
                </ol>
            </nav>
            <div class="row">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="row">
                @foreach ($category->quizzes as $quiz)
                    <div class="col-3 d-flex justify-content-center mt-3">
                        <div class="card box-shadow" style="width: 18rem; background-image: linear-gradient(#c1dfc4, #deecdd);">
                            <i class="fa-regular fa-bookmark"></i>
                            <a href="" class="text-reset text-decoration-none text-center">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $quiz->title }}</h5>
                                    <p class="card-text">{{ $quiz->description }}</p>
                                    <a href="{{ route('quiz.detail', ['id' => $quiz->id]) }}" class="btn btn-outline-info mt-2">Go</a>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
