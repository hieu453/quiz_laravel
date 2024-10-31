@extends('home.app')
@section('content')
    <div class="congratulation-area text-center mt-5">
        <div class="container">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="congratulation-contents-title"> Điểm của bạn là {{ $points }}! </h4>
                    <p class="congratulation-contents-para"> Bấm nút dưới để về trang chủ. </p>
                    <div class="btn-wrapper mt-4">
                        <a href="{{ route('index') }}" class="cmn-btn btn btn-primary"> Go to Home </a>
                        <a href="{{ route('show.correct', ['id' => $quiz_id]) }}" class="cmn-btn btn btn-success">Xem dap an</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
