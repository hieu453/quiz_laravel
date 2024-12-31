@extends('home.app')
@section('title', 'Danh mục')
@section('content')
<div class="container py-5 my-5 rounded border rounded">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item">Danh mục</li>
        </ol>
    </nav>
    <div class="row">
        <h1>Danh mục</h1>
    </div>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-3 my-3">
                <div class="card shadow bg-primary bg-opacity-25">
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
