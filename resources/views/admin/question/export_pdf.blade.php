@extends('admin.app')
@section('title', 'Môn học | Export câu hỏi')
@section('content')
@if(session('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('danger') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{ route('question.export.download') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Danh mục</label>
        <select name="category" id="category" class="form-select">
            <option value="" selected>Chọn danh mục</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Môn học</label>
        <select name="quiz" id="quiz" class="form-select">
            <option value="" selected>Chọn môn học</option>
        </select>
    </div>
    <button type="submit" class="btn btn-outline-dark">Export</button>
    <a href="{{ route('question.all') }}" class="btn btn-outline-secondary">Trở lại</a>
</form>


{{-- <div class="mb-3">
    <label class="form-label">Môn học</label>
    <form action="{{ route('question.export.download') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <select class="form-select" name="quiz_id">
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline-dark">Export</button>
        <a href="{{ route('question.all') }}" class="btn btn-outline-secondary">Trở lại</a>
    </form>
</div> --}}
@endsection
@push('javascript')
<script>
window.onload = function () {
    const categories =  {!! $categories !!};
    const quizzes = {!! $quizzes !!}

    const categorySel = document.getElementById('category')
    const quizSel = document.getElementById('quiz')

    for (const category of categories) {
        categorySel.options[categorySel.options.length] = new Option(category.name, category.id)
    }

    categorySel.onchange = function () {
        quizSel.length = 1

        for (const quiz of quizzes) {
            if (quiz.category_id == Number(this.value)) {
                quizSel.options[quizSel.options.length] = new Option(quiz.title, quiz.id)
            }
        }
    }
}
</script>
@endpush
