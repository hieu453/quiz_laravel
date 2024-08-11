@extends('home.app')
@section('content')
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Đăng nhập để làm bài
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Đăng ký</a>
            </div>
        </div>
    </div>
</div>
<h1>Quiz title</h1>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
@if (Auth::check())
<a href="{{ route('quiz.start', ['id' => $quiz->id]) }}" class="btn btn-primary">Bắt đầu làm bài</a>
@else
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Bắt đầu làm bài
</button>
@endif

<div class="row">
    <livewire:comments :model="$quiz"/>
</div>
@endsection
