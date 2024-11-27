@extends('home.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-2 py-5 mb-5 border rounded" style="background-image: linear-gradient(#D7FFFE, #FFFEFF);">
            <h2>Danh mục</h2>
            <div class="list-group list-group-flush">
                @foreach ($categories as $item)
                    @if ($item->name == $category->name)
                        <a href="{{ route('home.category.show', ['slug' => $item->slug]) }}" class="rounded list-group-item list-group-item-action active">{{ $item->name }}</a>
                    @else
                        <a href="{{ route('home.category.show', ['slug' => $item->slug]) }}" class="rounded list-group-item list-group-item-action">{{ $item->name }}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-10 py-5 mb-5 border rounded" style="background-image: linear-gradient(#FFFEFF, #D7FFFE);">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('home.category.all') }}">Danh mục</a></li>
                    <li class="breadcrumb-item">{{ $category->name }}</li>
                </ol>
            </nav>
            <div class="row">
                <h1>{{ $category->name }}</h1>
            </div>
            <div class="row">
                @foreach ($category->quizzes as $quiz)
                    {{-- <div class="col-lg-3 d-flex justify-content-center mt-3">
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
                    </div> --}}
                    <p><i class="fa-regular fa-hand-point-right"></i><a href="{{ route('quiz.detail', ['id' => $quiz->id]) }}" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"> {{ $quiz->title }}</a></p>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
