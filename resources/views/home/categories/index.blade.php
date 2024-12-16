@extends('home.app')
@section('title', 'Danh mục')
@section('content')
<div class="container py-5">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-secondary text-decoration-none">Trang chủ</a></li>
                <li class="breadcrumb-item">Danh mục</li>
            </ol>
        </nav>

        <h1 class="text-center">Danh mục</h1>
        @foreach ($categories as $category)
            <div class="col-lg-3 my-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                        <a href="{{ route('home.category.show', ['slug' => $category->slug]) }}" class="btn btn-outline-dark">Xem ngay</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
