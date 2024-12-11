@extends('home.app')
@section('content')
    <div class="congratulation-area text-center mt-5">
        <div class="container" style="min-height: 400px;">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon">
                        <img width="200" height="200" src="https://static1.squarespace.com/static/5a11e54080bd5e96f8b852b5/5a20b83153450a77d2f2f03c/5ceeaa0315fcc07f881fcee3/1559144997208/?format=1500w" alt="">
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
