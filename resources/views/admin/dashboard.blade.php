@extends('admin.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid px-4 rounded shadow" style="background-color: #e5e9ee;">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Danh mục ({{ $numberOfCategories }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('category.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Đề ({{ $numberOfQuizzes }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('quiz.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Câu hỏi ({{ $numberOfQuestions }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('question.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Người dùng ({{ $numberOfUsers }})</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('user.all') }}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
        Charts
        <div style="width: 18rem;">
            <canvas id="chartStatistics"></canvas>
        </div>
    </div>
@endsection
@push('javascript')
<script>
    const ctx = $('#chartStatistics')

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Đề', 'Câu hỏi', 'Danh mục', 'Người dùng'],
            datasets: [{
                label: 'Dataset',
                data: [{{ $numberOfQuizzes }}, {{ $numberOfQuestions }}, {{ $numberOfCategories }}, {{ $numberOfUsers }}],
                backgroundColor: [
                    'rgb(13, 110, 253)',
                    'rgb(255, 193, 7)',
                    'rgb(77, 164, 112)',
                    'rgb(220, 53, 69)'
                ],
                hoverOffset: 4,
                borderWidth: 0.5
            }],
        },
    });
</script>
@endpush
