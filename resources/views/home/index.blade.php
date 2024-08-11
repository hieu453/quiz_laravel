@extends('home.app')
@section('content')
<div class="container-fluid">
    @if(session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1 class="mt-4">Quizzes</h1>
    <div class="row">
        @foreach($quizzes as $quiz)
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{ $quiz->title }}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('quiz.start', ['id' => $quiz->id]) }}">Test</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}

            <div class="card" style="width: 18rem;">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <h5 class="card-title">{{ $quiz->title }}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    {{-- <a href="{{ route('quiz.start', ['id' => $quiz->id]) }}" class="btn btn-primary">Go somewhere</a> --}}
                    <a href="{{ route('quiz.detail', ['id' => $quiz->id]) }}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{ $quizzes->links() }}
    </div>
</div>
@endsection
