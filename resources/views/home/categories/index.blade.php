@extends('home.app')
@section('content')
<div class="container py-5 my-5 rounded" style="background-image: linear-gradient(#D7FFFE, #FFFEFF);">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item">Danh mục</li>
        </ol>
    </nav>
    <div class="row">
        <h1>Danh mục</h1>
    </div>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-lg-3 d-flex justify-content-center mt-3">
                <div class="card box-shadow" style="width: 18rem; background-image: linear-gradient(#c1dfc4, #deecdd);">
                    <i class="fa-regular fa-bookmark"></i>
                    <a href="" class="text-reset text-decoration-none text-center">
                        <div class="card-body text-center">
                            <h3 class="card-title">{{ $category->name }}</h3>
                            <a href="{{ route('home.category.show', ['slug' => $category->slug]) }}" class="card-link text-info"><i class="fa-regular fa-hand-point-right"></i> {{ count($category->quizzes) }} đề</a>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
