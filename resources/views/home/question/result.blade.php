@extends('home.app')
@section('title', 'Kết quả')
@section('content')
    <div class="congratulation-area text-center my-3 container-image">
        <div class="container" style="min-height: 400px;">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon">
                        <img class="rounded" width="200" height="200" src="{{ asset('images/result_congrats.png') }}">
                    </div>
                    <h4 class="congratulation-contents-title">Điểm của bạn:</h4>
                    <h1>{{ $points }}</h1>
                    <div class="btn-wrapper mt-4">
                        <a href="{{ route('index') }}" class="cmn-btn btn btn-outline-dark">Về trang chủ</a>
                        <a href="{{ route('show.correct', ['id' => $quiz_id]) }}" class="cmn-btn btn btn-outline-secondary">Xem đáp án</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
