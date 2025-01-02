@extends('home.app')
@section('title', 'Danh mục')
@section('content')
<div class="container py-5 bg-opacity-10" style="min-height: 90vh;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary bg-opacity-25 rounded px-2 py-2">
            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item">Danh mục</li>
        </ol>
    </nav>
    <div class="row bg-secondary bg-opacity-25 rounded">
        <h2 class="text-center">Danh mục</h2>
        @foreach ($categories as $category)
            <div class="col-3 my-3">
                <div class="card shadow bg-primary bg-opacity-25">
                    <img src="{{ asset('storage/category_image/'.$category->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                        <a href="{{ route('home.category.show', ['slug' => $category->slug]) }}" class="btn btn-outline-dark">Xem ngay</a>
                        <span class="float-end">
                            <i class="fa-solid fa-star"></i>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
