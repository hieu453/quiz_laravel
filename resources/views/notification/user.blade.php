@extends('home.app')
@section('title', 'Thông báo')
@section('content')
<div class="container mt-5">
    <div class="mb-3">
        <h3>Tất cả thông báo</h3>
    </div>
    @foreach (Auth::user()->notifications as $notification)
    <a href="{{ $notification->data['link'] }}" class="text-reset text-decoration-none notification-link">
        <div class="d-flex flex-row border rounded px-3 py-3 mb-3">
            <div class="d-flex align-items-center rounded-circle px-3" style="background-color: #cbc8c8;"><i class="fa-solid fa-user" style="font-size: 30px; padding: 10px;"></i></div>
            <div class="ms-3">
                <h4>{{ $notification->data['title'] }}</h4>
                <p>{{ $notification->data['body'] }}</p>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection
