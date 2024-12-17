@extends('home.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-2 mb-5 border rounded container-menu">
            <h2 class="title-category">Danh mục</h2>
            <ul class="" style="list-style-type: none;">
                @foreach ($categories as $item)
                    @if ($item->name == $category->name)
                        <li class="name-category px-2 py-2 active rounded">
                            <a href="{{ route('home.category.show', ['slug' => $item->slug]) }}" class="name-category text-secondary text-decoration-none text-dark">{{ $item->name }}</a>
                        </li>
                    @else
                        <li class="px-2 py-2 rounded">
                            <a href="{{ route('home.category.show', ['slug' => $item->slug]) }}" class="text-secondary text-decoration-none">{{ $item->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-10 py-5 mb-5 border rounded detail-category">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none title-detail">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('home.category.all') }}" class="text-secondary text-decoration-none title-detail">Danh mục</a></li>
                    <li class="breadcrumb-item title-detail">{{ $category->name }}</li>
                </ol>
            </nav>
            <div class="row">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="row">
                @foreach ($category->quizzes as $quiz)
                    {{-- <div class="col-lg-3 d-flex justify-content-center mt-3">
                        <div class="card box-shadow" style="width: 18rem;">
                            <i class="fa-regular fa-bookmark"></i>
                            <a href="" class="text-reset text-decoration-none text-center">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $quiz->title }}</h5>
                                    <p class="card-text">{{ $quiz->description }}</p>
                                    <a href="{{ route('quiz.detail', ['id' => $quiz->id]) }}" class="btn btn-outline-info mt-2">Go</a>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    <p><i class="fa-regular fa-hand-point-right"></i><a href="{{ route('quiz.detail', ['id' => $quiz->id]) }}" class="text-decoration-none text-secondary"> {{ $quiz->title }}</a></p>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
