@extends('admin.app')
@section('title', 'Tất cả phản hồi')
@section('content')
<div class="container mt-5">
    <div class="mb-3">
        <h3>Chi tiết phản hồi</h3>
    </div>
    <hr>
    <div>
        <h4>{{ $notification->data['title'] }}</h4>
        <i>{{ $notification->data['body'] }}</i>
    </div>
    {{-- <a class="btn btn-outline-success mt-2">Duyệt</a> --}}
    <a href="{{ route('feedback') }}" class="btn btn-outline-secondary mt-2">Trở lại</a>
</div>
@endsection
